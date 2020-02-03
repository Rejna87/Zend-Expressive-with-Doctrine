<?php


namespace UserManagement\Handler;


use App\Service\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManagement\Form\UserForm;
use UserManagement\Service\UserService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class CreateUserHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;
    /** @var UserForm */
    private $form;

    /** @var AuthService */
    private $authService;
    /** @var UserService */
    private $userService;

    /**
     * Login constructor.
     * @param TemplateRendererInterface $template
     * @param AuthService $authService
     * @param UserService $userService
     * @param UserForm $userForm
     */
    public function __construct(TemplateRendererInterface $template, AuthService $authService, UserService $userService, UserForm $userForm)
    {
        $this->template = $template;
        $this->authService = $authService;
        $this->userService = $userService;
        $this->form = $userForm;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->authService->prepareSession($request);
        if (!$this->authService->checkCurrentLogin()) {
            return new RedirectResponse('/login');
        }
        if (!$this->authService->isAdmin()) {
            return new HtmlResponse(
                $this->template->render('error::404', [
                ])
            );
        }

        $users = $this->userService->getUsers();
        $error = 0;
        $success = 0;

        $userGroups = $this->userService->getUserGroups();
        $userGroupsArray = [];
        foreach ($userGroups AS $groupEntity) {
            $userGroupsArray[$groupEntity->getId()] = $groupEntity->getName();
        }
        $this->form->get('userGroup')->setValueOptions($userGroupsArray);

        if ($request->getMethod() === 'POST') {
            $this->form->setData($request->getParsedBody());
            if ($this->form->isValid()) {
                $post = $request->getParsedBody();
                $success = $this->userService->createUser(
                    $post['username'],
                    $post['password'],
                    $post['userGroup'],
                    $post['mail'],
                    $post['firstname'],
                    $post['lastname']
                );

                if ($success) {
                    return new RedirectResponse('/user/list?created=true');
                }
            }
        }


        return new HtmlResponse(
            $this->template->render('usermanagement::user', [
                'form' => $this->form,
                'errors' => $error,
                'success' => $success,
            ])
        );
    }


}