<?php


namespace UserManagement\Handler;


use App\Service\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManagement\Service\UserService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserListHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var AuthService */
    private $authService;
    /** @var UserService */
    private $userService;

    /**
     * Login constructor.
     * @param TemplateRendererInterface $template
     * @param AuthService $authService
     * @param UserService $userService
     */
    public function __construct(TemplateRendererInterface $template, AuthService $authService, UserService $userService)
    {
        $this->template = $template;
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->authService->prepareSession($request);
        if (!$this->authService->checkCurrentLogin() && !$this->authService->isAdmin()) {
            return new RedirectResponse('/login');
        }
        if (!$this->authService->isAdmin()) {
            return new HtmlResponse(
                $this->template->render('error::404', [
                ])
            );
        }

        $users = $this->userService->getUsers();
//        if($request->getMethod() === 'POST') {

//        }

        return new HtmlResponse(
            $this->template->render('usermanagement::list', [
                'users' => $users
            ])
        );
    }


}