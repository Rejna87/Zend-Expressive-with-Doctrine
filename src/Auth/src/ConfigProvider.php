<?php


namespace Auth;



use Auth\Handler\LoginHandler;
use Auth\Handler\LoginHandlerFactory;

class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
//            'delegators' => [
//            ],
            'invokables' => [
            ],
            'factories'  => [
                LoginHandler::class => LoginHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'auth'    => [__DIR__ . '/../templates/auth'],
            ],
        ];
    }
}