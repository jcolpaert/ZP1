<?php

/**
 * Creating site navigation
 *
 * @author xavierdekeyster
 */
class ZMenu_Navigation_Navigation extends Zend_Controller_Plugin_Abstract {
    
    /* predispatch to check the module name
     * @ params Zend_Controller_Request_Abstract
     * 
     * return Zend_Navigation
     */
    
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        $leftNavigation = $this->makeMainNavigation(); 
        
        // get the layout instance
        $layout = new Zend_Layout();
        // get the view instance of the layout
        $view = $layout->getView();
        
        // put the left navigation depending on module
        $view->navigation($leftNavigation);

    }
    
    public function makeMainNavigation()
    {
        $mainMenu = new Zend_Navigation(); // maken van de navigatie

        $db = Zend_Registry::get('db');
        $pages = $db->fetchAll("SELECT * FROM page, pageLang WHERE page.status = 'active' AND page.pageID = pageLang.pageFK ORDER BY page.pageID ASC");
        $urls = array();
        foreach($pages as $page) {
            $urls[] = array('label' => $page['titel'], 'action' => $page['action'], 'controller' => $page['controller'], 'class' => '', 'params' => array('id' => $page['pageLangID']));
        }
        
        foreach($urls as $url) {
            $page = new Zend_Navigation_Page_Mvc(array(
                'label' => $url['label'],
                'action' => $url['action'],
                'class' => $url['class'],
                'controller' => $url['controller'],
                'route' => 'default',
                'params' => $url['params'],
            ));
            
            // Voeg deze toe aan de container
            $mainMenu->addPage($page);
        }

        return $mainMenu;
    }
    
}