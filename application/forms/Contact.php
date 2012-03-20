<?php

class Application_Form_Contact extends Zend_Form
{

    public function init()
    {
        
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement(new Zend_Form_Element_Text('voornaam', array(
            'label' => 'Voornaam',
            'filter' => array('stringTrim'),
            'required' => true,
        )));
        
        $this->addElement(new Zend_Form_Element_Text('naam', array(
            'label' => 'Naam',
            'filter' => array('stringTrim'),
            'required' => true,
        )));
        
        $this->addElement(new Zend_Form_Element_Text('email', array(
            'label' => 'E-mail',
            'filter' => array('stringTrim'),
            'validators' => array(
                array('EmailAddress'),
                array('StringLength', true, array('max' => 50))
            ),
            'required' => true,
        )));
        
        $btn = new Zend_Form_Element_Button('submit', array(
            'type' => 'submit',
            'value' => 'Stuur mail',
            'required' => false,
            'ignore' => true,
        ));
        $this->addElement($btn);
        
    }


}

