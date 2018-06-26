<?php

namespace PS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;

use Jagilpe\EncryptionBundle\Entity\PKEncryptionEnabledUserInterface;
use Jagilpe\EncryptionBundle\Entity\Traits\EncryptionEnabledUserTrait;



/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="PS\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()

 */
class User extends BaseUser implements PKEncryptionEnabledUserInterface
{
	use EncryptionEnabledUserTrait;

	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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
     * @var string
     *
     * @ORM\Column(name="parrain", type="string", length=150, nullable=true)
     */
    private $parrain;
    



    /**
     * Set parrain
     *
     * @param string $parrain
     *
     * @return User
     */
    public function setParrain($parrain)
    {
        $this->parrain = $parrain;

        return $this;
    }

    /**
     * Get parrain
     *
     * @return string
     */
    public function getParrain()
    {
        return $this->parrain;
    }
}
