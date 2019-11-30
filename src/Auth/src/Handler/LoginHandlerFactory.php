<?php


namespace Auth\Handler;



use App\Service\AuthService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class LoginHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) :RequestHandlerInterface
    {
        /** @var TemplateRendererInterface $template */
        $template = $container->get(TemplateRendererInterface::class);
        /** @var AuthService $authService */
        $authService = $container->get(AuthService::class);
        return new LoginHandler($template, $authService);
    }


}