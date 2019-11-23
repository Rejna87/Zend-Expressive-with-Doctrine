<?php
declare(script_type=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Foo
 *
 * @ORM\Entity
 * @ORM\Table(name="foo")
 */
class Foo
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", unique=true)
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}