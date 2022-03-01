<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $name;

  /**
   * @ORM\Column(type="datetime")
   */
  private $start_date;

  /**
   * @ORM\Column(type="datetime")
   */
  private $end_date;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $location;

  /**
   * @ORM\Column(type="string", length=100)
   */
  private $city;

  /**
   * @ORM\Column(type="string", length=5)
   */
  private $postal_code;

  /**
   * @ORM\Column(type="decimal", precision=5, scale=2)
   * @Assert\GreaterThanOrEqual(0)
   */
  private $price;

  /**
   * @ORM\Column(type="boolean", options={"default"=false})
   */
  private $active;

  /**
   * @ORM\ManyToMany(targetEntity=User::class, mappedBy="Events")
   */
  private $users;

  /**
   * @ORM\Column(type="text", nullable=true)
   */
  private $description;

  /**
   * @ORM\Column(type="integer")
   */
  private $seats;

  /**
   * @ORM\ManyToMany(targetEntity=Collective::class, mappedBy="events")
   */
  private $collectives;

  public function __construct()
  {
      $this->users = new ArrayCollection();
      $this->collectives = new ArrayCollection();
  }

  public function __toString()
  {
    return $this->name;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getStartDate(): ?\DateTimeInterface
  {
    return $this->start_date;
  }

  public function setStartDate(\DateTimeInterface $start_date): self
  {
    $this->start_date = $start_date;

    return $this;
  }

  public function getEndDate(): ?\DateTimeInterface
  {
    return $this->end_date;
  }

  public function setEndDate(\DateTimeInterface $end_date): self
  {
    $this->end_date = $end_date;

    return $this;
  }

  public function getLocation(): ?string
  {
    return $this->location;
  }

  public function setLocation(?string $location): self
  {
    $this->location = $location;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(string $city): self
  {
    $this->city = $city;

    return $this;
  }

  public function getPostalCode(): ?string
  {
    return $this->postal_code;
  }

  public function setPostalCode(string $postal_code): self
  {
    $this->postal_code = $postal_code;

    return $this;
  }

  public function getPrice(): ?string
  {
    return $this->price;
  }

  public function setPrice(string $price): self
  {
    $this->price = $price;

    return $this;
  }

  public function getActive(): ?bool
  {
    return $this->active;
  }

  public function setActive(bool $active): self
  {
    $this->active = $active;

    return $this;
  }

  /**
   * @return Collection|User[]
   */
  public function getUsers(): Collection
  {
      return $this->users;
  }

  public function addUser(User $user): self
  {
      if (!$this->users->contains($user)) {
          $this->users[] = $user;
          $user->addEvent($this);
      }

      return $this;
  }

  public function removeUser(User $user): self
  {
      if ($this->users->removeElement($user)) {
          $user->removeEvent($this);
      }

      return $this;
  }

  public function getDescription(): ?string
  {
      return $this->description;
  }

  public function setDescription(?string $description): self
  {
      $this->description = $description;

      return $this;
  }

  public function getSeats(): ?int
  {
      return $this->seats;
  }

  public function setSeats(int $seats): self
  {
      $this->seats = $seats;

      return $this;
  }

  /**
   * @return Collection|Collective[]
   */
  public function getCollectives(): Collection
  {
      return $this->collectives;
  }

  public function addCollective(Collective $collective): self
  {
      if (!$this->collectives->contains($collective)) {
          $this->collectives[] = $collective;
          $collective->addEvent($this);
      }

      return $this;
  }

  public function removeCollective(Collective $collective): self
  {
      if ($this->collectives->removeElement($collective)) {
          $collective->removeEvent($this);
      }

      return $this;
  }
}
