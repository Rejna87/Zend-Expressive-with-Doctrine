<?php /** @noinspection PhpUnusedAliasInspection */


namespace UserManagement\Handler;



use App\Service\AuthService;
use Auth\Form\LoginForm;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManagement\Form\UserForm;
use UserManagement\Service\UserService;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\FormElementManagerFactory;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Form\FormElementManager;


class CreateUserHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) :RequestHandlerInterface
    {
        /** @var TemplateRendererInterface $template */
        $template = $container->get(TemplateRendererInterface::class);
        /** @var UserForm $userForm */
        $userForm = $container->get(FormElementManager::class)
            ->get(UserForm::class);
        $authService = $container->get(AuthService::class);

        $userService = $container->get(UserService::class);

        return new CreateUserHandler($template, $authService, $userService, $userForm);
    }


}