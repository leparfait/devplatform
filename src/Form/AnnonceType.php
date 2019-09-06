<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('imageFile',FileType::class,[ // imageUrl qui doit etre ici
                'required'=>false
            ])
            ->add('explication',CKEditorType::Class)
            ->add('degre' , ChoiceType::class,[
                'choices'=>$this->getChoice()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }

    public function getChoice()
    {
       $degre = [1,2,3];
       $output = [];
    foreach($degre as $k => $v){
       $output[$v]=$k;  
    }
       return $output;
    }
}
