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
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     options={"default"="nextval('orders_id_seq'::regclass)"}
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \LongevoBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="LongevoBundle\Entity\Customer", inversedBy="orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_customer", referencedColumnName="id")
     * })
     */
    private $customer;

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
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return Order
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return Order
     */
    public function setProduct($product)
    {
        $this->product = $product;
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
     * @return Order
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
     * @return Order
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}