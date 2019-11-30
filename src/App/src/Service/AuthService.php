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

    public function checkLogin($userName, $userPassword) {
        $userEntity = $this->userRepository->checkLogin($userName, $userPassword);

        return $userEntity;
    }
}