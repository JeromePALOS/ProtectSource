<?php

namespace PS\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', TextType::class)
			->add('type')
			->add('instruction', TextareaType::class))
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
