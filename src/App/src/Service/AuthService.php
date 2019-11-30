<?php


namespace App\Service;


use App\Repository\UserRepository;

class AuthService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function checkLogin() {
        $userEntity = $this->userRepository->checkLogin('ShinoRej2', 'Test123');

        return $userEntity;
    }
}