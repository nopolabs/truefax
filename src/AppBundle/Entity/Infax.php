<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * In-bound fax
 *
 * @ApiResource
 * @ORM\Entity
 */
class Infax
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
     * @var string url for fax pdf
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $url = '';

    /**
     * @var string fax source number
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $number = '';

    public function getId()
    {
        return $this->id;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
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
