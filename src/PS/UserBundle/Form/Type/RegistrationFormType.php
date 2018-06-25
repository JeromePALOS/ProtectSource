<?php
 
namespace FOS\UserBundle\Form\Type;
namespace PS\PlatformBundle\Form\Type
 
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PS\PlatformBundle\Form\Type\RegistrationFormType as BaseType;
 
class RegistrationFormType extends BaseType
{
 
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parrain');
         
    }
     
     public function getParent()
    {
        return 'fos_user_registration';
    }
 
     public function getParrain()
    {
        return 'app_user_registration';
    }
	    public function getName()
    {
        return 'xxxxxxxxx à toi';
    }
}