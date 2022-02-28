<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Event;
use App\Repository\RoleRepository;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\fr_FR\PhoneNumber;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
  protected $manager;
  protected $roleRepository;
  protected $faker;
  protected $passwordHasher;

  public function __construct(EntityManagerInterface $manager, RoleRepository $roleRepository, UserPasswordHasherInterface $passwordHasher)
  {
    $this->manager = $manager;
    $this->roleRepository = $roleRepository;
    $this->faker = Factory::create('fr_FR');
    $this->passwordHasher = $passwordHasher;
  }

  public function load(ObjectManager $manager): void
  {
    $this->create_roles();
    $this->create_users();
    $this->create_events();
    $manager->flush();
  }

  public function create_roles(): void
  {
    $roleArray = ["ROLE_USER", "ROLE_ADMIN", "ROLE_DISABLED"];
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
    $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
    $admin->setFirstname('Maëva');
    $admin->setLastname('Mezzasalma');
    $admin->setBirthdate($this->faker->dateTime);
    $admin->setEmail('maeva.mezza38@gmail.com');
    $admin->setPhone($this->faker->mobileNumber());
    $admin->setPassword("password");
    // hash the password (based on the security.yaml config for the $user class)
    $hashedPassword = $this->passwordHasher->hashPassword(
      $admin,
      'password'
    );
    $admin->setPassword($hashedPassword);
    $this->manager->persist($admin);

    for ($u = 0; $u < 20; $u++) {
      $user = new User();
      $user->setRoles(['ROLE_USER']);
      $user->setFirstname($this->faker->firstName());
      $user->setLastname($this->faker->lastName());
      $user->setBirthdate($this->faker->dateTime);
      $user->setEmail($this->faker->email);
      $user->setPhone($this->faker->mobileNumber());
      $user->setPassword($this->faker->password());
      $this->manager->persist($user);
    }
    $this->manager->flush();
  }

  public function create_events(): void
  {
    for ($u = 0; $u < 20; $u++) {
      $event = new Event();
      var_dump($event);
      $event->setName($this->faker->word());
      $event->setStartDate($this->faker->dateTimeBetween('-2 years', '+5 years'));
      // $event->setEndDate(date_add($event->getStartDate(), date_interval_create_from_date_string('5 hours')));
      var_dump($event->getStartDate());
      var_dump($event->getStartDate()->add(new DateInterval('P03D')));
      $startDate = $event->getStartDate();
      $endDate = $startDate->add(new DateInterval('P03D'));
      $event->setEndDate($endDate);
      $event->setCity($this->faker->city());
      $event->setPostalCode($this->faker->postcode());
      $event->setPrice(13.99);
      $event->setNumberPlaces(500);
      $event->setActive(true);
      $this->manager->persist($event);
      $this->manager->flush();
    }
  }
}
