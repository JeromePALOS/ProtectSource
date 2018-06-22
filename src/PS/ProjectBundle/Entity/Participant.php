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
	 * @ORM\ManyToOne(targetEntity="PS\ProjectBundle\Entity\Project", cascade={"persist"}, inversedBy="participants")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE"))
	 */
	private $project;
	
    
    //viewProject
	/**
     * @ORM\Column(name="permissionProjectView", type="boolean")
     */
    private $permissionProjectView; 
    
    //permission parametre project
	/**
     * @ORM\Column(name="permissionProjectParameter", type="boolean")
     */
    private $permissionProjectParameter;
	
    //add participant
	/**
     * @ORM\Column(name="permissionParticipantAdd", type="boolean")
     */
    private $permissionParticipantAdd;
    
    //delete participant
    /**
     * @ORM\Column(name="permissionParticipantDelete", type="boolean")
     */
    private $permissionParticipantDelete;
    
    //change permission 
    /**
     * @ORM\Column(name="permissionParticipantPermission", type="boolean")
     */
    private $permissionParticipantPermission;
    
    //create, edit, delete
	/**
     * @ORM\Column(name="permissionArticle", type="boolean")
     */
    private $permissionArticle;
	
    //
	/**
     * @ORM\Column(name="permissionInformationAdd", type="boolean")
     */
    private $permissionInformationAdd;
    
    //refuse information
    /**
     * @ORM\Column(name="permissionInformationDelete", type="boolean")
     */
    private $permissionInformationDelete;
    
   public function __construct(){

	}
	
	
	
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

    /**
     * Set permissionProject
     *
     * @param boolean $permissionProject
     *
     * @return Participant
     */
    public function setPermissionProject($permissionProject)
    {
        $this->permissionProject = $permissionProject;

        return $this;
    }

    /**
     * Get permissionProject
     *
     * @return boolean
     */
    public function getPermissionProject()
    {
        return $this->permissionProject;
    }

    /**
     * Set permissionParticipant
     *
     * @param boolean $permissionParticipant
     *
     * @return Participant
     */
    public function setPermissionParticipant($permissionParticipant)
    {
        $this->permissionParticipant = $permissionParticipant;

        return $this;
    }

    /**
     * Get permissionParticipant
     *
     * @return boolean
     */
    public function getPermissionParticipant()
    {
        return $this->permissionParticipant;
    }

    /**
     * Set permissionArticle
     *
     * @param boolean $permissionArticle
     *
     * @return Participant
     */
    public function setPermissionArticle($permissionArticle)
    {
        $this->permissionArticle = $permissionArticle;

        return $this;
    }

    /**
     * Get permissionArticle
     *
     * @return boolean
     */
    public function getPermissionArticle()
    {
        return $this->permissionArticle;
    }

    /**
     * Set permissionInformation
     *
     * @param boolean $permissionInformation
     *
     * @return Participant
     */
    public function setPermissionInformation($permissionInformation)
    {
        $this->permissionInformation = $permissionInformation;

        return $this;
    }

    /**
     * Get permissionInformation
     *
     * @return boolean
     */
    public function getPermissionInformation()
    {
        return $this->permissionInformation;
    }

    /**
     * Set permissionProjectView
     *
     * @param boolean $permissionProjectView
     *
     * @return Participant
     */
    public function setPermissionProjectView($permissionProjectView)
    {
        $this->permissionProjectView = $permissionProjectView;

        return $this;
    }

    /**
     * Get permissionProjectView
     *
     * @return boolean
     */
    public function getPermissionProjectView()
    {
        return $this->permissionProjectView;
    }

    /**
     * Set permissionProjectParameter
     *
     * @param boolean $permissionProjectParameter
     *
     * @return Participant
     */
    public function setPermissionProjectParameter($permissionProjectParameter)
    {
        $this->permissionProjectParameter = $permissionProjectParameter;

        return $this;
    }

    /**
     * Get permissionProjectParameter
     *
     * @return boolean
     */
    public function getPermissionProjectParameter()
    {
        return $this->permissionProjectParameter;
    }

    /**
     * Set permissionParticipantAdd
     *
     * @param boolean $permissionParticipantAdd
     *
     * @return Participant
     */
    public function setPermissionParticipantAdd($permissionParticipantAdd)
    {
        $this->permissionParticipantAdd = $permissionParticipantAdd;

        return $this;
    }

    /**
     * Get permissionParticipantAdd
     *
     * @return boolean
     */
    public function getPermissionParticipantAdd()
    {
        return $this->permissionParticipantAdd;
    }

    /**
     * Set permissionParticipantDelete
     *
     * @param boolean $permissionParticipantDelete
     *
     * @return Participant
     */
    public function setPermissionParticipantDelete($permissionParticipantDelete)
    {
        $this->permissionParticipantDelete = $permissionParticipantDelete;

        return $this;
    }

    /**
     * Get permissionParticipantDelete
     *
     * @return boolean
     */
    public function getPermissionParticipantDelete()
    {
        return $this->permissionParticipantDelete;
    }

    /**
     * Set permissionParticipantPermission
     *
     * @param boolean $permissionParticipantPermission
     *
     * @return Participant
     */
    public function setPermissionParticipantPermission($permissionParticipantPermission)
    {
        $this->permissionParticipantPermission = $permissionParticipantPermission;

        return $this;
    }

    /**
     * Get permissionParticipantPermission
     *
     * @return boolean
     */
    public function getPermissionParticipantPermission()
    {
        return $this->permissionParticipantPermission;
    }

    /**
     * Set permissionInformationAdd
     *
     * @param boolean $permissionInformationAdd
     *
     * @return Participant
     */
    public function setPermissionInformationAdd($permissionInformationAdd)
    {
        $this->permissionInformationAdd = $permissionInformationAdd;

        return $this;
    }

    /**
     * Get permissionInformationAdd
     *
     * @return boolean
     */
    public function getPermissionInformationAdd()
    {
        return $this->permissionInformationAdd;
    }

    /**
     * Set permissionInformationDelete
     *
     * @param boolean $permissionInformationDelete
     *
     * @return Participant
     */
    public function setPermissionInformationDelete($permissionInformationDelete)
    {
        $this->permissionInformationDelete = $permissionInformationDelete;

        return $this;
    }

    /**
     * Get permissionInformationDelete
     *
     * @return boolean
     */
    public function getPermissionInformationDelete()
    {
        return $this->permissionInformationDelete;
    }
}
