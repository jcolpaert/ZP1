<?php

class Application_Form_Page extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement(new Zend_Form_Element_Text('titel', array(
            'label' => 'Titel',
            'filter' => array('stringTrim'),
            'required' => true,
        )));
        
        $this->addElement(new Zend_Form_Element_Textarea('inhoud', array(
            'label' => 'Inhoud',
            'filter' => array('stringTrim'),
            'required' => true,
            'rows' => '5',
            'cols' => '50',
        )));
        
        $btn = new Zend_Form_Element_Button('submit', array(
            'type' => 'submit',
            'value' => 'Voeg nieuwsbericht toe',
            'required' => false,
            'ignore' => true,
        ));
        $this->addElement($btn);
    }

}

