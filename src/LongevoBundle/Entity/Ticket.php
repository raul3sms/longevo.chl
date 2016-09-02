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
 * @ORM\Table(name="tickets")
 */
class Ticket
{
    /**
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     options={"default"="nextval('tickets_id_seq'::regclass)"}
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \LongevoBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="LongevoBundle\Entity\Customer", inversedBy="tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_customer", referencedColumnName="id")
     * })
     */
    private $customer;

    /**
     * @var \LongevoBundle\Entity\Order
     *
     * @ORM\ManyToOne(targetEntity="LongevoBundle\Entity\Order", inversedBy="tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_order", referencedColumnName="id")
     * })
     */
    private $order;

    /**
     * @ORM\Column(
     *     name="title",
     *     type="string",
     *     length=200,
     *     nullable=false
     * )
     */
    private $title;
    /**
     * @ORM\Column(
     *     name="observation",
     *     type="text",
     *     length=200
     * )
     */
    private $observation;
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
     * @return Ticket
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Ticket
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return Ticket
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Ticket
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param mixed $observation
     * @return Ticket
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;
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
     * @return Ticket
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
     * @return Ticket
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}