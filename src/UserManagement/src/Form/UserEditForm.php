<?php


namespace UserManagement\Form;


use Zend\Form\Element\Password;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class UserEditForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('user-form', []);
    }

    public function init()
    {
        $this->add(
            [
                'type' => 'hidden',
                'name' => 'userid',
                'options' => [
                    'label' => 'Benutzerid'
                ]
            ]
        );


        $this->add(
            [
                'type' => Text::class,
                'name' => 'mail',
                'options' => [
                    'label' => 'E-Mail',
                ],
            ]
        );

        $this->add(
            [
                'type' => Text::class,
                'name' => 'firstname',
                'options' => [
                    'label' => 'Vorname',
                ],
            ]
        );
        $this->add(
            [
                'type' => Text::class,
                'name' => 'lastname',
                'options' => [
                    'label' => 'Nachname',
                ],
            ]
        );

        $this->add(
            [
                'type' => Select::class,
                'name' => 'userGroup',
                'attributes' => [
                    'label' => 'Benutzergruppe',
                ],
            ]
        );


        $this->add(
            [
                'type' => Submit::class,
                'name' => 'submit',
                'attributes' => [
                    'value' => 'Speichern',
                ],
            ]
        );
    }


    public function getInputFilterSpecification()
    {
        return [
            [
                'name' => 'mail',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],
            [
                'name' => 'firstname',
                'required' => false,
                'filters' => [
                ],
            ],
            [
                'name' => 'lastname',
                'required' => false,
                'filters' => [
                ],
            ],
            [
                'name' => 'userGroup',
                'required' => true,
                'filters' => [
                ],
            ],
        ];
    }

}