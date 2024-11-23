<?php

namespace App\Form;


use App\Entity\Team;
use App\Entity\Dresseur;
use App\Form\Type\ApiTeamType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TeamType extends AbstractType
{

    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('name', TextType::class, [
            'attr' => [
                'placeholder' => 'Nommez votre équipe'
            ],
            'required' => true,
        ])
        // ->add('pokemons', CollectionType::class, [
        //     'entry_type' => TextType::class,
        //     'allow_add' => true,
        //     'allow_delete' => true,
        // ])
        ->add('save', SubmitType::class, [
            'label' => 'Créer l\'équipe',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
     

    ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
