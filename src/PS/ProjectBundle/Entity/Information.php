<?php

namespace PS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table(name="information")
 * @ORM\Entity(repositoryClass="PS\ProjectBundle\Repository\InformationRepository")
 */
class Information
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typeInformation", type="string", length=255, nullable=true)
     */
    private $typeInformation;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeInformation
     *
     * @param string $typeInformation
     *
     * @return Information
     */
    public function setTypeInformation($typeInformation)
    {
        $this->typeInformation = $typeInformation;

        return $this;
    }

    /**
     * Get typeInformation
     *
     * @return string
     */
    public function getTypeInformation()
    {
        return $this->typeInformation;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Information
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Information
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}

