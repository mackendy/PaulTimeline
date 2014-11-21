<?php

namespace Paul\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        parent::buildForm($builder, $options);
        $builder
            ->add('username')
            ->add('email')
            ->add('password')

        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'paul_user_registration';
    }
}
