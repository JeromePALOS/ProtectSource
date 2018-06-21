<?php

namespace PS\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParticipantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('UserX', TextType::class, array('label'=> 'User Name', 'mapped' => false))
        	->add('permissionProjectView',      	    CheckboxType::class, array('attr' => array('checked'   => 'checked'), 'required' => false))
			->add('permissionProjectParameter',         CheckboxType::class, array('required' => false))
			->add('permissionArticle',      		    CheckboxType::class, array('attr' => array('checked'   => 'checked'), 'required' => false))
			->add('permissionInformationAdd',        	CheckboxType::class, array('attr' => array('checked'   => 'checked'), 'required' => false))
			->add('permissionInformationDelete',        CheckboxType::class, array('attr' => array('checked'   => 'checked'), 'required' => false))
			->add('permissionParticipantAdd',      	    CheckboxType::class, array('required' => false))
			->add('permissionParticipantDelete',      	CheckboxType::class, array('required' => false))
			->add('permissionParticipantPermission',    CheckboxType::class, array('required' => false))
			->add('Add',     			                 SubmitType::class)
			
			
		;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\ProjectBundle\Entity\Participant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ps_projectbundle_participant';
    }


}
