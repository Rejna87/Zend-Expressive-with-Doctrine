<?php


namespace Auth\Form;


use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class LoginForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('login-form', []);
    }

    public function init()
    {

        $this->add(
            [
                'type' => Text::class,
                'name' => 'username',
                'options' => [
                    'label' => 'Benutzername'
                ]
            ]
        );

        $this->add(
            [
                'type' => Password::class,
                'name' => 'password',
                'options' => [
                    'label' => 'Passwort',
                ],
            ]
        );

        $this->add(
            [
                'type' => Submit::class,
                'name' => 'submit',
                'attributes' => [
                    'value' => 'Login',
                ],
            ]
        );

    }

    public function getInputFilterSpecification()
    {
        return [
            [
                'name' => 'username',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],
            [
                'name' => 'password',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],
        ];
    }

}