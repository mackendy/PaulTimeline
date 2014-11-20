<?php

namespace Paul\TimelineBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;



class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',array(
                'attr' => array('class'=>'form-control')
            ))
            ->add('content','textarea',array(
                'attr' => array(
                    'class'=>'form-control tinymce',
                    'rows'=> '3',
                    'data-theme' => 'advanced'
                )
            ))
            ->add('DateEvent','genemu_jquerydate',array(
                'widget' => 'single_text',
                'attr'=> array('class'=>' date')
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
            ->add('save', 'submit', array(
                'label' => 'Create Post',
                'attr' => array('class' => 'btn btn-default')

            ));



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
