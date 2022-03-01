<?php

namespace App\Form;

use App\Entity\Collective;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class CollectiveType extends AbstractType
{
  private $security;

  public function __construct(Security $security)
  {
    $this->security = $security;
  }

  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class)
      ->add('city', TextType::class);
      //->add('haveAccount', CheckboxType::class, [
      //  'mapped' => false
      //]);

    if(!$this->security->getUser()) {
      $builder->add('members', CollectionType::class, [
        'entry_type' => UserType::class,
        'entry_options' => ['label' => false],
        'allow_add' => true,
        //'prototype' => true,
      ]);
    }
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Collective::class,
    ]);
  }
}
