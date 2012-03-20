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
    
    protected function _initRegisterControllerPlugins() {

        $this->bootstrap('frontController') ;

        $front = $this->getResource('frontController') ;

        $front->registerPlugin(new ZMenu_Navigation_Navigation());

    }
    
    public function _initView()
    {
        $view = new Zend_View(); // maak een instantie van de view
        $view->setEncoding('utf-8');
        
        // layout ophalen
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $layout->setLayout('layout');
        
        //return $container;
    }

}

