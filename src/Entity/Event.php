<?php

namespace App\Entity;

use App\Repository\EventRepository;
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
  private $date;

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
   * @ORM\Column(type="integer")
   * @Assert\GreaterThanOrEqual(0)
   */
  private $number_places;

  /**
   * @ORM\Column(type="boolean", options={"default"=false})
   */
  private $active;

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

  public function getDate(): ?\DateTimeInterface
  {
    return $this->date;
  }

  public function setDate(\DateTimeInterface $date): self
  {
    $this->date = $date;

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

  public function getNumberPlaces(): ?int
  {
    return $this->number_places;
  }

  public function setNumberPlaces(int $number_places): self
  {
    $this->number_places = $number_places;

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

}
