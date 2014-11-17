<?php

namespace Paul\TimelineBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('date')
            ->add('title','text',array(
                'attr' => array('class'=>'form-control')
            ))
            //->add('author', null, array('required' => 'required',))
            ->add('content','textarea',array(
                'attr' => array(
                    'class'=>'form-control',
                    'rows'=> '3'
                )
            ))
            ->add('type','choice', array(
                'attr' => array('class'=>'form-control'),
                'choices' => array(
                    'pencil' => 'Text',
                    'quote-right'=>'Citation',
                    'camera'=>'Photo',
                    'video-camera' => 'video',
                )
             ))


            /**->add('Media', 'checkbox', array(
                'label'     => 'add media ?',
                'required'  => false,
                'mapped' => false
            ))
             * **/
            ->add('save', 'submit', array('label' => 'Create Post'))
        ;


    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Paul\TimelineBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'paul_timelinebundle_post';
    }
}
