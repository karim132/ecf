<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Users;
use App\Entity\Salle;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut',DateTimeType::class,[
                'attr'=> ['class'=>'form-control'],
                'widget' => 'single_text',
               
                
                
            ])
            ->add('dateFin',DateTimeType::class,[
                'attr'=> ['class'=>'form-control'],
                'widget' => 'single_text',
            ])
            
            //  ->add('salle',EntityType::class,[
            //     // 'mapped'=> false,
            //     'class'=> Salle::class,
            //     'choice_label'=> 'nom',
            //     'label' => 'Confirmez le numéro de la salle',
            //     'attr'=> ['class'=>'form-control']

            //  ])
            
             
            //    ->add('user',EntityType::class,[
            //   'mapped'=> false,
            //    'class'=> Users::class,
            //    'choice_label'=> 'nom',
            //    'label' => 'Client',
            //    'attr'=> ['class'=>'form-control']
            //   ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
