<?php

class Application_Form_Nieuws extends Zend_Form
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
        
        $this->addElement(new Zend_Form_Element_Textarea('omschrijving', array(
            'label' => 'Omschrijving',
            'filter' => array('stringTrim'),
            'required' => true,
            'rows' => '5',
            'cols' => '50',
        )));

        $this->addElement(new Zend_Form_Element_Text('datum', array(
            'label' => 'Datum',
            'filter' => array('stringTrim'),
            'required' => true,
            'Validators' => array(
                array('Date'),
                array('StringLength', true, array('max' => 20)),
            ),
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

