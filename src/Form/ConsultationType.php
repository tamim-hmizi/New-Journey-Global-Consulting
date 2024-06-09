<?php

namespace App\Form;

use App\Entity\Consultation;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{


    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('Name', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('LastName', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('DateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('Email', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('PhoneNumber', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('Profession', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('PostalAddress', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('City', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('PostalCode', null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('MeetingDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control meeting-date'],
            ])
            ->add('MeetingHour', ChoiceType::class, [
                'choices' => [
                    "08:00" =>   new DateTime('08:00'),
                    "09:00" =>  new DateTime('09:00'),
                    "10:00" =>  new DateTime('10:00'),
                    "11:00" =>  new DateTime('11:00'),
                    "12:00" =>   new DateTime('12:00'),
                    "13:00" =>  new DateTime('13:00'),
                    "14:00" =>  new DateTime('14:00'),
                    "15:00" =>  new DateTime('15:00'),
                    "16:00" =>  new DateTime('16:00'),
                    "17:00" =>   new DateTime('17:00'),
                    "18:00" =>  new DateTime('18:00')
                ],
                'placeholder' => "Sélectionnez l'heure de la réunion",
                'attr' => ['class' => 'form-control'],
            ])
            ->add(
                'Type',
                ChoiceType::class,
                [
                    'choices' => [
                        'Études' => 'Etudes',
                        'Immigration' => 'Immigration',
                        'Travail' => 'Travail',
                        'Visa de visiteur' => 'Visa de visiteur',
                    ],
                    'placeholder' => 'Sélectionnez le type',
                    'attr' => ['class' => 'form-control'],
                ]
            )
            ->add('Submit', SubmitType::class, [
                'attr' => ['class' => 'form-control  btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
