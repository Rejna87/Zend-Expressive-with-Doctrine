<?php /** @noinspection PhpUnusedAliasInspection */


namespace UserManagement\Handler;



use App\Service\AuthService;
use Auth\Form\LoginForm;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManagement\Service\UserService;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\FormElementManagerFactory;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Form\FormElementManager;

class UserListHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) :RequestHandlerInterface
    {
        /** @var TemplateRendererInterface $template */
        $template = $container->get(TemplateRendererInterface::class);
        /** @var LoginForm $loginForm */
//        $loginForm = $container->get(FormElementManager::class)
//            ->get(LoginForm::class);
        $authService = $container->get(AuthService::class);

        $userService = $container->get(UserService::class);

        return new UserListHandler($template, $authService, $userService);
    }


}