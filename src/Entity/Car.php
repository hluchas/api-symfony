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
     * @var int
     */
    private $userId = 0;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     *
     * @var string
     */
    private $status;
}