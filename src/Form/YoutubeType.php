<?php

namespace App\Form;

use Google\Service\YouTube\Resource\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class YoutubeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('query', SearchType::class, [
                'label' => 'Rechercher des vidéos',
                'attr' => [
                'placeholder' => 'Entrez un terme de recherche'
                ],
            ])
            // ->add('title', SearchType::class, [
            //     'label' => 'Titre de la vidéo',
            //     'required' => false,])
            ->add('max_results', IntegerType::class)
            // ->add('order', ChoiceType::class, [
            //     'label' => 'Ordre des résultats',
            //     'choices' => [
            //         'Pertinence' => 'relevance',
            //         'Date' => 'date',
            //         'Note' => 'rating',
            //         'Titre' => 'title',
            //         'Nombre de vidéos' => 'videoCount',
            //         'Nombre de vues' => 'viewCount',
            //     ],
            // ])
            ->add('video_category_id', HiddenType::class)
            ->add('region_code', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'api_key' => 'AIzaSyDyJEReIqr2FCSfW4XGIbo_MPufZH7lx2w', // Clé API YouTube
            'max_results' => 25, // Nombre maximum de résultats à retourner
            // 'order' => 'relevance', // Ordre des résultats (relevance, date, rating, title, videoCount, viewCount)
            'video_category_id' => null, // ID de la catégorie de vidéos
            'region_code' => null, // Code région pour les résultats localisés
            'query_options' => [], // Ajoutez cette ligne pour définir les options du champ $query
        ]);
    }
}
