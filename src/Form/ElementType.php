<?php

namespace App\Form;


use App\Entity\Element;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('specificite')
            ->add("illustration",FileType::class,[
                'data_class' => null,
                // mapped false permet "d'extraire"
                // un input du reste du formulaire. Ca évite qu'un input soit lié à l'objet envoyé dans le formulaire
                'mapped' => false,
                'required' => false,
                'constraints'=> [
                    new File ([
                        'maxSize' => '6000k',
                        'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'],
                    ]),
                ],
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
    }
}
