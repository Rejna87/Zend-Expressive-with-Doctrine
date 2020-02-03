<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class UserEntity
 * @package App\Entity
 * https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/basic-mapping.html
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class UserEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", unique=true)
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="username", type="string", length=50)
     */
    private $username;
    /**
     * @var string
     * @ORM\Column(name="frst_name", type="string", length=50)
     */
    private $firstName;
    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", length=50)
     */
    private $lastName;
    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=260)
     */
    private $password;
    /**
     * @var string
     * @ORM\Column(name="mail", type="string", length=50)
     */
    private $mail;
    /**
     * @var string
     * @ORM\Column(name="session_key", type="string", length=50, nullable=true)
     */
    private $sessionKey;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastActivity;

    /**
     * @var UserGroupEntity
     * @ORM\ManyToOne(targetEntity="UserGroupEntity")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $userGroup;


    /**
     * @var string
     * @ORM\Column(name="disabled", type="boolean", options={"unsigned":true, "default":false})
     */
    private $disabled;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }

    /**
     * @param string $sessionKey
     */
    public function setSessionKey(string $sessionKey): void
    {
        $this->sessionKey = $sessionKey;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * @param \DateTime $lastActivity
     */
    public function setLastActivity(\DateTime $lastActivity): void
    {
        $this->lastActivity = $lastActivity;
    }

    /**
     * @return string
     */
    public function getDisabled(): string
    {
        return $this->disabled;
    }

    /**
     * @param string $disabled
     */
    public function setDisabled(string $disabled): void
    {
        $this->disabled = $disabled;
    }

    /**
     * @return UserGroupEntity
     */
    public function getUserGroup(): UserGroupEntity
    {
        return $this->userGroup;
    }

    /**
     * @param UserGroupEntity|int $userGroup
     */
    public function setUserGroup(UserGroupEntity $userGroup): void
    {
        $this->userGroup = $userGroup;
    }


}