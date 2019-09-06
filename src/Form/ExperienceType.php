<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poste',null, array('label' => 'Poste occupé'))
            ->add('debut',BirthdayType::class, array('label' => 'date de debut'))
            ->add('fin',BirthdayType::class, array('label' => 'date de fin'))
            ->add('entreprise',null, array('label' => 'Entreprise'))
            ->add('description',TextareaType::class, array('label' => 'Taches quotidiennes'))
            ->add('actuelposte',CheckboxType::class, array('label' => 'Poste actuel'))
            // ->add('createdAt')
            // ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
