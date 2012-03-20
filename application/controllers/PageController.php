<?php

class PageController extends Zend_Controller_Action
{

    public function init()
    {
        $id = $this->_getParam('id');
        
        if(is_numeric($id)) {
            $pageLangTable = new Application_Model_PageLang();
            $page = $pageLangTable->find($id)->current();
            $page = reset($page);

            $this->view->title = $page['titel'];
            $this->view->content = $page['content'];
        }
    }

    public function indexAction()
    {
    }
    
    public function contactAction() {
        $this->view->form = new Application_Form_Contact();
        
        // Controle en e-mail versturen
        if ($this->getRequest()->isPost()) {
            
            // POST variabelen ophalen
            $postParams = $this->getRequest()->getPost();
            
            if ($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();
                
                /*echo '<pre>';
                print_r($params);
                echo '</pre>';*/
                
                $body = '';
                $body .= '<p>Info via website</p>';
                $body .= '<p>Naam: ' . $params['naam'] . '</p>';
                $body .= '<p>Voornaam: ' . $params['voornaam'] . '</p>';
                $body .= '<p>E-mail: ' . $params['email'] . '</p>';
                
                $mail = new Zend_Mail();
                $mail->addTo('jan.de.wilde87@gmail.com', 'Jan De Wilde');
                $mail->setSubject('Info via website');
                $mail->setBodyHtml($body);
                $mail->setFrom($params['email'], $params['naam'] . ' ' . $params['voornaam']);
                $mail->send();
                
                echo "<p>Uw mail werd verzonden!</p>";
            }
            
        }
    }

    public function addAction() {
        
        // TODO
        
        /*$this->view->form = new Application_Form_Page();
        
        if ($this->getRequest()->isPost()) {
            
            // POST variabelen ophalen
            $postParams = $this->getRequest()->getPost();
            
            if ($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();
                
                $pageTable = new Application_Model_Page();
                $pageTable->insert($params);
                
                echo "Pagina toegevoegd";
                
            }
        }*/
        
    }

}

