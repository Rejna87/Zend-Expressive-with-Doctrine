<?php


namespace Auth\Handler;


use App\Service\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    private $loginForm;
    /** @var AuthService */
    private $authService;

    /**
     * Login constructor.
     * @param TemplateRendererInterface $template
     * @param AuthService $authService
     */
    public function __construct(TemplateRendererInterface $template, AuthService $authService)
    {
        $this->template = $template;
        $this->authService = $authService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        return new HtmlResponse(
            $this->template->render('auth::login-mask', [
                'test' => 'test'
            ])
        );
    }


}