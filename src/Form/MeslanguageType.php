<?php

namespace App\Form;

use App\Entity\Meslanguage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MeslanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveau',ChoiceType::class,[
                           'choices'=>$this->getChoice(),
                        ])
            ->add('languageId')
            // ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meslanguage::class,
        ]);
    }

    public function getChoice()
    {
        $degre = ['debutant','junior','senior','expert'];
        $output = [];
        foreach($degre as $k => $v){
            $output[$v]=$k;  
        }
            return $output;
    }
}