<?php

namespace PS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="PS\ProjectBundle\Repository\ParticipantRepository")
 */
class Participant
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
	 * @ORM\ManyToOne(targetEntity="PS\UserBundle\Entity\User")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE"))
	 */
	private $user;
	
	/**
	 * @ORM\ManyToOne(targetEntity="PS\ProjectBundle\Entity\Project")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE"))
	 */
	private $project;
	
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
     * Set user
     *
     * @param \PS\UserBundle\Entity\User $user
     *
     * @return Participant
     */
    public function setUser(\PS\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PS\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param \PS\ProjectBundle\Entity\Project $project
     *
     * @return Participant
     */
    public function setProject(\PS\ProjectBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \PS\ProjectBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
