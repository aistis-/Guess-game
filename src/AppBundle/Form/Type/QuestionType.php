<?php

namespace AppBundle\Form\Type;

use AppBundle\Model\Issue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question')
            ->add('guess')
            ->add('save', 'submit', ['attr' => ['class' => 'btn-default']])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Question'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'question';
    }
} 
