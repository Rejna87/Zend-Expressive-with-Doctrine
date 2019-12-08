<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class UserEntity
 * @package App\Entity
 * https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/basic-mapping.html
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserGroupRepository")
 * @ORM\Table(name="user_group")
 */
class UserGroupEntity
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(name="disabled", type="boolean", options={"unsigned":true, "default":true})
     */
    private $disabled;

    /**
     * @var UserEntity[]
     * @ORM\OneToMany(targetEntity="UserEntity", mappedBy="userGroup")
     */
    private $user;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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


}