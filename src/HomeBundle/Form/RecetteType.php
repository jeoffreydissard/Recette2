<?php

namespace HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',     TextType::class)
            ->add('photo', FileType::class, array('label' => 'insert_photo', 'label_attr' => array(
                'class' => "material-icons  insertphoto"
            ),'attr' => array(
                'style' => "visibility: hidden;"
            )))
            ->add('categorie', ChoiceType::class, array(
                'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>
                    array
                    (
                        'Entrée' => 'Entrée',
                        'Plats' => 'Plats',
                        'Sauces' => 'Sauces',
                        'Dessert' => 'Dessert',
                    ) ,
                'multiple' => false,
                'required' => true,
            ))
            ->add('temps',     TextType::class)
            ->add('ingredients',     TextareaType::class,array('attr' => array(
                'rows' => "4",
                'contenteditable' => "true")))
            ->add('nbPersonnes',     NumberType::class)
            ->add('preparation',   TextareaType::class,array('attr' => array(
                'rows' => "8")))
            ->add('Ajouter', SubmitType::class,array('attr' => array(
                'class' => "waves-effect waves-light btn jaune black-text inscrit"
            )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HomeBundle\Entity\Recette'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'homebundle_recette';
    }


}
