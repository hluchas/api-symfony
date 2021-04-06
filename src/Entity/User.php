<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(
 *     name="user",
 *     indexes={
 *          @ORM\Index(name="first_name_idx", columns={"first_name"}),
 *          @ORM\Index(name="last_name_idx", columns={"last_name"})
 *     },
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="email_idx", columns={"email"})
 *     }
 * )
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     *
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     *
     * @var string
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     * @Assert\Email
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     *
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Rental", mappedBy="userId")
     *
     * @var Rental[]|ArrayCollection
     */
    private $rentals;

    /**
     * @ORM\OneToMany(targetEntity="Car", mappedBy="userId")
     *
     * @var Car
     */
    private $car;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->rentals = new ArrayCollection();
    }

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): \DateTime
    {
        if (!$this->createdAt instanceof \DateTime) {
            $this->createdAt = new \DateTime();
        };

        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedNow(): void
    {
        if (!$this->updatedAt instanceof \DateTime) {
            $this->updatedAt = new \DateTime();
        } else {
            $this->updatedAt->modify('now');
        }
    }

    /**
     * @return Rental[]|ArrayCollection
     */
    public function getRentals()
    {
        return $this->rentals;
    }

    public function addRental(Rental $rental): void
    {
        $this->rentals->add($rental);
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): void
    {
        $this->car = $car;
    }
}
