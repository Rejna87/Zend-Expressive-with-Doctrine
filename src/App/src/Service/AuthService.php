<?php


namespace App\Service;


use App\Entity\UserEntity;
use App\Repository\UserRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;

class AuthService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var ServerRequestInterface
     */
    protected $request;
    /**
     * @var ServerRequestInterface
     */
    protected $session;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }


    public function checkLogin($userName, $userPassword)
    {
        /** @var UserEntity $userEntity */
        $userEntity = $this->userRepository->checkLogin($userName, $userPassword);
        if (!is_null($userEntity)) {
            $valid = 1;
            $sessionKey = md5($userEntity->getId() . '_' . $userEntity->getUsername() . '_' . time());
            $this->session->set('userGroupId', $userEntity->getUserGroup()->getId());
            $this->session->set('userId', $userEntity->getId());
            $this->session->set('sessionKey', $sessionKey);

            $userEntity->setSessionKey($sessionKey);
            $userEntity->setLastActivity(new \DateTime());
            $this->userRepository->update($userEntity);
        } else {
            $valid = 3;
        }
        return $userEntity;
    }

    public function isAdmin() {
        if($this->session->get('userGroupId') == 1) {
            return true;
        }
        return false;
    }


    /**
     * @param ServerRequestInterface $request
     */
    public function prepareSession(ServerRequestInterface $request): void
    {
        /** @var SessionInterface $session */
        $this->session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
    }

    public function checkCurrentLogin()
    {
        if($this->session->has('userId') && $this->session->has('sessionKey')) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        $this->session->clear();
    }

}