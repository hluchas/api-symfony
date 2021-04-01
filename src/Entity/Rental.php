<?php


namespace App\Entity;

use App\Repository\RentalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RentalRepository::class)
 * @ORM\Table(
 *     name="rental",
 *     indexes={
 *          @ORM\Index(name="from_idx", columns={"from"}),
 *          @ORM\Index(name="to_idx", columns={"to"}),
 *     }
 *  )
 */
class Rental
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="rentals")
     * @ORM\JoinColumn(name="rental_id", referencedColumnName="id")
     *
     * @var User
     */
    private $user;

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
}