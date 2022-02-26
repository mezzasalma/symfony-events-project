<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class)
      ->add('start_date', DateTimeType::class)
      ->add('end_date', DateTimeType::class)
      ->add('location', TextType::class, ['required' => false])
      ->add('city', TextType::class)
      ->add('postal_code', TextType::class)
      ->add('price', MoneyType::class)
      ->add('number_places', IntegerType::class)
      ->add('description', TextareaType::class)
      ->add('active', CheckboxType::class, ['required' => false]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Event::class,
    ]);
  }
}
