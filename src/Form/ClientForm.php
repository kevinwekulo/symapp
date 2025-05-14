<?php

namespace App\Form;

use Dom\Text;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Client Name',
                'attr' => [
                    'placeholder' => 'Enter client name',
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone Number',
                'attr' => [
                    'placeholder' => 'Enter phone number',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
