<?php

namespace PS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="PS\ProjectBundle\Repository\ArticleRepository")
 */
class Article
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Article
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

    /**
     * Set user
     *
     * @param \PS\UserBundle\Entity\User $user
     *
     * @return Article
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
     * @return Article
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
