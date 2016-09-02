<?php
namespace LongevoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Customers
 * @package LongevoBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="customers")
 * @UniqueEntity(
 *     fields={"email"},
 *     errorPath="email",
 *     message="Esse e-mail já foi registrado"
 * )
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     options={"default"="nextval('customers_id_seq'::regclass)"}
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=100
     * )
     * @Assert\NotBlank(message="Campo nome não pode ficar em branco")
     */
    private $name;
    /**
     * @ORM\Column(
     *     name="email",
     *     type="string",
     *     length=100
     * )
     * @Assert\NotBlank(message="Campo e-mail não pode ficar em branco")
     * @Assert\Email(message="Invalid e-mail address")
     */
    private $email;
    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     name="created_at",
     *     type="datetime",
     *     nullable=false
     * )
     */
    private $createdAt;
    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     name="updated_at",
     *     type="datetime",
     *     nullable=true
     * )
     */
    private $updatedAt;

    /**
     * Start the new entity with createdAt value filled
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Customer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Customer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Customer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}