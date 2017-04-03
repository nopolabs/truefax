<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Out-bound fax
 *
 * @ApiResource
 * @ORM\Entity
 */
class Outfax
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string fax body
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $text = '';

    /**
     * @var string fax destination number
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $number = '';

    public function getId()
    {
        return $this->id;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getNumber() : string
    {
        return $this->number;
    }

    public function setNumber(string $number)
    {
        $this->number = $number;
    }
}
