<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Element;
use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PokemonType extends AbstractType
{
    // injection de l'entitymanager dans le formulaire

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, [
                'data_class' => null,
                // mapped false permet "d'extraire"
                // un input du reste du formulaire. Ca évite qu'un input soit lié à l'objet envoyé dans le formulaire
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'],
                    ]),
                ],
            ])
            ->add('element', EntityType::class, [
                'class' => Element::class,
                'choice_label' => 'Specificite',
            ])

            // ->add('level', RangeType::class)
            ->add('level', NumberType::class)
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir une équipe',
                'data' => $this->entityManager->getRepository(Team::class)->find(1), // Team avec id 1 par défaut
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
