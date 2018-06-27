<?php

namespace PS\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;



class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name',					TextType::class)
			->add('visibility', 			CheckboxType::class,
				array('required' => false, 
				'label' => 'Participant can view',
				'attr' => array('checked'   => 'checked'),			//1 = yes 0 = no
			))

			->add('instruction', 			TextareaType::class, array(
                'attr' => array('rows' => '6'),
				'label'=> 'Instruction in case of problems'
			))

      ->add('files', 				FilesType::class, array('required' => false, 'label' => false))


			->add('Create',     			SubmitType::class)
		;
    }
	
	
	
	/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\ProjectBundle\Entity\Project'
        ));
    }
	
	
	

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ps_projectbundle_project';
    }


}
