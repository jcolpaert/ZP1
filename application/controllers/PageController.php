<?php

class PageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $id = $this->_getParam('id');
        
        $db = Zend_Registry::get('db');
        $page = reset($db->fetchAll("SELECT * FROM pageLang pageLang WHERE pageLangID = " . $id));
        
        $this->view->title = $page['titel'];
        $this->view->content = $page['content'];
    }

    public function addAction() {
        
        $this->view->form = new Application_Form_Page();
        
        if ($this->getRequest()->isPost()) {
            
            // POST variabelen ophalen
            $postParams = $this->getRequest()->getPost();
            
            if ($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();
                
                $pageTable = new Application_Model_Page();
                $pageTable->insert($params);
                
                echo "Pagina toegevoegd";
                
            }
        }
        
    }

}

