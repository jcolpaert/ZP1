<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initDbAdapter() {
        $this->bootstrap('db');
        $db = $this->getResource('db');
        // Maak een soort global variabele aan
        Zend_Registry::set('db', $db);
        
        // Waar nodig (indien gebruik gemaakt van model van DB niet nodig)
        // $db = Zend_Registry::get('db');
    }
    
    public function _initView()
    {
        $view = new Zend_View(); // maak een instantie van de view
        $view->setEncoding('utf-8');
        
        // layout ophalen
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $layout->setLayout('layout');

        $container = new Zend_Navigation(); // maken van de navigatie

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
            $container->addPage($page);
        }
        
        $view = $layout->getView();
        $view->navigation($container);
        
        //return $container;
    }

}

