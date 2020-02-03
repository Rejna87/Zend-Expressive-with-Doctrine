<?php


namespace UserManagement;



use UserManagement\Handler\CreateUserHandler;
use UserManagement\Handler\CreateUserHandlerFactory;
use UserManagement\Handler\EditUserHandler;
use UserManagement\Handler\EditUserHandlerFactory;
use UserManagement\Handler\UserListHandler;
use UserManagement\Handler\UserListHandlerFactory;
use UserManagement\Service\UserService;
use UserManagement\Service\UserServiceFactory;

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
                UserListHandler::class => UserListHandlerFactory::class,
                CreateUserHandler::class => CreateUserHandlerFactory::class,
                EditUserHandler::class => EditUserHandlerFactory::class,
                // Service
                UserService::class => UserServiceFactory::class,
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
                'usermanagement'    => [__DIR__ . '/../templates/usermanagement'],
            ],
        ];
    }
}