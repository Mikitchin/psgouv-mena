<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('lieuNaisssance')
            ->add('genre')
            ->add('situationMatrimoniale')
            ->add('emploi')
            ->add('discipline')
            ->add('nomPere')
            ->add('prenomPere')
            ->add('nomMere')
            ->add('prenomMere')
            ->add('diplome')
            ->add('contact')
            ->add('drena')
            ->add('structure');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
