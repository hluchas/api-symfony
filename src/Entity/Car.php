<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 * @ORM\Table(
 *     name="car",
 *     indexes={
 *          @ORM\Index(name="from_idx", columns={"from"}),
 *          @ORM\Index(name="to_idx", columns={"to"}),
 *     }
 *  )
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     *
     * @var \DateTime
     */
    private $from;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     *
     * @var \DateTime
     */
    private $to;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="car")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
     *
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     *
     * @var string
     */
    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getFrom(): \DateTime
    {
        return $this->from;
    }

    /**
     * @param \DateTime $from
     */
    public function setFrom(\DateTime $from): void
    {
        $this->from = $from;
    }

    /**
     * @return \DateTime
     */
    public function getTo(): \DateTime
    {
        return $this->to;
    }

    /**
     * @param \DateTime $to
     */
    public function setTo(\DateTime $to): void
    {
        $this->to = $to;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}