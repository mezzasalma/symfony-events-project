<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  protected $manager;
  protected $roleRepository;

  public function __construct(EntityManagerInterface $manager, RoleRepository $roleRepository) {
    $this->manager = $manager;
    $this->roleRepository = $roleRepository;
  }

  public function load(ObjectManager $manager): void
  {
    $this->create_roles();
    $this->create_users();

    $manager->flush();
  }

  public function create_roles(): void
  {
    $roleArray = ["admin", "member", "disabled"];
    for ($r = 0; $r < count($roleArray); $r++) {
      $role = new Role();
      $role->setType($roleArray[$r]);
      $this->manager->persist($role);
      $this->manager->flush();
    }
  }

  public function create_users(): void
  {
    $admin = new User();
    $admin->setRole($this->roleRepository->findOneBy(array('type' => 'admin')));
    $admin->setFirstname('Maëva');
    $admin->setLastname('Mezzasalma');
    $admin->setBirthdate(new \DateTime('1999-05-19'));
    $admin->setEmail('maeva.mezza38@gmail.com');
    $admin->setPhone('0600000000');
    $this->manager->persist($admin);
    $this->manager->flush();
  }

  public function create_events(ObjectManager $manager): void
  {

  }
}
