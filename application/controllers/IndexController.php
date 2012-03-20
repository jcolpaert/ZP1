<?php

class IndexController extends Zend_Controller_Action
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
        // action body
    }


}

