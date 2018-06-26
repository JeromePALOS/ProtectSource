<?php

namespace PS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Jagilpe\EncryptionBundle\Annotation\EncryptedEntity;
use Jagilpe\EncryptionBundle\Entity\SystemEncryptableEntity;
use Jagilpe\EncryptionBundle\Entity\Traits\SystemEncryptableEntityTrait;
use Jagilpe\EncryptionBundle\Annotation\EncryptedField;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="PS\ProjectBundle\Repository\ProjectRepository")
  * @ORM\HasLifecycleCallbacks()
   * @EncryptedEntity(enabled=true, mode="SYSTEM_ENCRYPTION")
 */
class Project implements SystemEncryptableEntity
{
	use SystemEncryptableEntityTrait;
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
	* @ORM\OneToMany(targetEntity="PS\ProjectBundle\Entity\Participant", mappedBy="project")
	*/
	private $participants;
	
	/**
	 * @ORM\ManyToOne(targetEntity="PS\UserBundle\Entity\User")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE"))
	 */
	private $user;
	
    /**
	* @ORM\OneToOne(targetEntity="PS\ProjectBundle\Entity\Files", cascade={"persist", "remove"})
	* @Assert\Valid()
	*/
	private $files;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150)
	 * @EncryptedField
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="visibility", type="boolean")
     */
    private $visibility;

    /**
     * @var string
     *
     * @ORM\Column(name="keyProject", type="string", length=255)
     */
    private $keyProject;

    /**
     * @var string
     *
	 * @EncryptedField
     * @ORM\Column(name="instruction", type="text")
     */
    private $instruction;
	
	
	public function __construct(){
		// Par défaut, la date du project est la date d'aujourd'hui
		$this->dateCreation = new \Datetime();
		$this->keyProject = $this->random(10);
	}
	
	function random($car) {
		$string = "";
		$chaine = "abcdefghijklmnpqrstuvwxy";
		srand((double)microtime()*1000000);
		for($i=0; $i<$car; $i++) {
			$string .= $chaine[rand()%strlen($chaine)];
		}
		return $string;
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
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Project
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }


    /**
     * Set keyProject
     *
     * @param string $keyProject
     *
     * @return Project
     */
    public function setKeyProject($keyProject)
    {
        $this->keyProject = $keyProject;

        return $this;
    }

    /**
     * Get keyProject
     *
     * @return string
     */
    public function getKeyProject()
    {
        return $this->keyProject;
    }

    /**
     * Set instruction
     *
     * @param string $instruction
     *
     * @return Project
     */
    public function setInstruction($instruction)
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * Get instruction
     *
     * @return string
     */
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * Set user
     *
     * @param \PS\ProjectBundle\Entity\Project $user
     *
     * @return Project
     */
    public function setUser(\PS\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PS\ProjectBundle\Entity\Project
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Set visibility
     *
     * @param boolean $visibility
     *
     * @return Project
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return boolean
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set files
     *
     * @param \PS\ProjectBundle\Entity\Files $files
     *
     * @return Project
     */
    public function setFiles(\PS\ProjectBundle\Entity\Files $files = null)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get files
     *
     * @return \PS\ProjectBundle\Entity\Files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Add participant
     *
     * @param \PS\ProjectBundle\Entity\Participant $participant
     *
     * @return Project
     */
    public function addParticipant(\PS\ProjectBundle\Entity\Participant $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \PS\ProjectBundle\Entity\Participant $participant
     */
    public function removeParticipant(\PS\ProjectBundle\Entity\Participant $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }
}
