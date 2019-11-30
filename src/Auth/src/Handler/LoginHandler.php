<?php


namespace Auth\Handler;


use App\Service\AuthService;
use Auth\Form\LoginForm;
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
     * @param LoginForm $loginForm
     */
    public function __construct(TemplateRendererInterface $template, AuthService $authService, LoginForm $loginForm)
    {
        $this->template = $template;
        $this->authService = $authService;
        $this->loginForm = $loginForm;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $valid = 0;
        if($request->getMethod() === 'POST') {
            $valid = 2;
            $this->loginForm->setData($request->getParsedBody());
            if($this->loginForm->isValid()) {
                $post = $request->getParsedBody();
                $userEntity = $this->authService->checkLogin($post['username'], $post['password']);
                if(!is_null($userEntity)) {
                    $valid = 1;
                } else {
                    $valid = 3;
                }
            }
        }

        return new HtmlResponse(
            $this->template->render('auth::login-mask', [
                'test' => 'test',
                'form' => $this->loginForm,
                'validTest' => $valid,
//                'urlCol' => $urlCollection,
            ])
        );
    }


}