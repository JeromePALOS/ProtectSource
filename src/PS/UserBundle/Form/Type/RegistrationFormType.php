<?php
namespace PS\UserBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderinterface;
 
class RegistrationType extends AbstractType{
     
    public function buildForm(\Symfony\Component\Form\FormBuilderinterface $builder, array $options)
    {
        $builder
                ->add('parrain')
;
    }
 
    public function getParent(){
        return 'fos_user_registration';
    }
 
    public function getName(){
        return 'ps_user_registration';
    }
 
}