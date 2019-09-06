<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNais',BirthdayType::class, array('label' => 'date de naissance'))
            // ->add('imageFile',FileType::class, array('label' => 'photo de profil',
            //                                         'required'=> false))
            ->add('imageFile',VichImageType::class, array(
                'label' => false,
                'required' => false,
                'allow_delete' => true,
                'attr' => array(
                    'type' => 'file',
                    'data-preview-file-type' => 'text',
                    'multiple' => '',
                    'data-allowed-file-extensions' => '["jpeg", "png", "jpg"]',
                    'language' => 'fr'
                )
            ))
            // ->add('updated_at')
            ->add('titre')
            ->add('pays',CountryType::class, array('label' => 'votre pays'))
            ->add('adresse')
            // ->add('createdAt')
            ->add('telephone')
            // ->add('UserId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
