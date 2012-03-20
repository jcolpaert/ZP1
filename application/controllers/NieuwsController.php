<?php

class NieuwsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $id = $this->_getParam('id');
        
        if(is_numeric($id)) {
            $pageLangTable = new Application_Model_PageLang();
            $page = $pageLangTable->find($id)->current();
            $page = reset($page);


            $this->view->title = $page['titel'];
            $this->view->content = $page['content'];
        }
        
        $table = new Application_Model_Nieuws();
        $rows = $table->fetchAll();
        
        $this->view->nieuws = $rows;
    }

    public function toevoegenAction()
    {
        $this->view->form = new Application_Form_Nieuws();
        
        // Controle en e-mail versturen
        if ($this->getRequest()->isPost()) {
            
            // POST variabelen ophalen
            $postParams = $this->getRequest()->getPost();
            
            if ($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();
                
                //$db = Zend_Registry::get('db');
                //$query = "INSERT INTO nieuws (titel, omschrijving, datum) VALUES (?)";
                //$query = $db->quoteInto($query, array($params['titel'], $params['omschrijving'], $params['datum']));
                //$db->query($query);
                
                
                /**
                 * Via model
                 */
                $nieuwsTable = new Application_Model_Nieuws();
                $nieuwsTable->insert($params);
                
                echo "Nieuwsbericht toegevoegd";
                
                
                /**
                 * Update
                 * 
                 * $data = array(); with values
                 * $where = $db->quoteInto('id = ?', 1);
                 * $table->update($data, $where);
                 */
                
                /**
                 * Delete
                 * 
                 * $where = $db->quoteInto('id = ?', 2);
                 * $table->delete($where);
                 */
                
                /**
                 * Find by primary key or keys (in array format)
                 * Returns a rowset
                 * 
                 * $primaryKey = 1
                 * $primaryKey = array(1, 2, 3, 4)
                 * 
                 * $table->find($primaryKey);
                 * $table->find($primaryKey)->current(); geeft een enkele dimensie terug
                 */
                
            }
        }
        
    }

    public function wijzigenAction()
    {
        $id = $this->_getParam('id'); // $_GET['']
        
        $form = new Application_Form_Nieuws();
        
        $nieuwsTable = new Application_Model_Nieuws();
        $nieuwsItem = $nieuwsTable->find($id)->current(); // current() geeft een enkele dimensie terug
        $nieuwsItem = reset($nieuwsItem); // reset plaatst de pointer naar de array met enkel de gegevens opgevraagd, geen extra object informatie
        
        $form->populate($nieuwsItem);
        
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            
            // POST variabelen ophalen
            $postParams = $this->getRequest()->getPost();
            
            if ($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();
                
                $where = $nieuwsTable->getAdapter()->quoteInto('id = ?', $id);
                $nieuwsTable->update($params, $where);
                
                echo "Nieuwsbericht gewijzigd";
            }
            
        }
    }
    
    public function verwijderAction() {
        $id = $this->_getParam('id'); // $_GET['']
        
        if(!empty($id)) {
        
            $nieuwsTable = new Application_Model_Nieuws();
            $where = $nieuwsTable->getAdapter()->quoteInto('id = ?', $id);
            $nieuwsTable->delete($where);

            echo "Bericht is gewist";
        
        }
    }

}