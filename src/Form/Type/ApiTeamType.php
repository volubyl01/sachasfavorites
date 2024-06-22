<?php 
// src/Form/Type/ApiDataType.php
namespace App\Form\Type;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ApiTeamType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
      
            $resolver->setDefaults([
                'data_class' => Team::class,
                'api_sprites' => [],
                'api_pokemons' => [],
            ]);
        
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
