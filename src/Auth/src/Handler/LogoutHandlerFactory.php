<?php /** @noinspection PhpUnusedAliasInspection */


namespace Auth\Handler;



use App\Service\AuthService;
use Auth\Form\LoginForm;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\FormElementManagerFactory;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Form\FormElementManager;

class LogoutHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) :RequestHandlerInterface
    {
        /** @var TemplateRendererInterface $template */
        $template = $container->get(TemplateRendererInterface::class);
        $authService = $container->get(AuthService::class);
        return new LogoutHandler($template, $authService);
    }


}