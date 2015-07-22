<?php

namespace DataSourceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('first_name')
            ->add('last_name')
            ->add('birthday')
            ->add('phone')
            ->add('photo')
            ->add('job_title')
            ->add('social_network')
            ->add('sex')
            ->add('salary_min')
            ->add('salary_max')
            ->add('major_category_id')
            ->add('categories_json')
            ->add('education_json')
            ->add('skill_json')
            ->add('job_history_json')
            ->add('last_view')
            ->add('last_login')
            ->add('profile_type')
            ->add('status')
            ->add('view')
            ->add('created_at')
            ->add('updated_at')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DataSourceBundle\Entity\Profile'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'datasourcebundle_profile';
    }
}
