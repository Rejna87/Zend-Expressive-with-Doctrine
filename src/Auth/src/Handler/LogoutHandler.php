<?php


namespace Auth\Handler;


use App\Entity\UserEntity;
use App\Service\AuthService;
use Auth\Form\LoginForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Expressive\Template\TemplateRendererInterface;

class LogoutHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var AuthService */
    private $authService;

    /**
     * Login constructor.
     * @param TemplateRendererInterface $template
     * @param AuthService $authService
     * @param LoginForm $loginForm
     */
    public function __construct(TemplateRendererInterface $template, AuthService $authService)
    {
        $this->template = $template;
        $this->authService = $authService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->authService->prepareSession($request);

        $this->authService->logout();

        return new RedirectResponse('/login');

    }


}