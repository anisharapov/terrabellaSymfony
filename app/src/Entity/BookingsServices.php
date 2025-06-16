<?php

namespace App\Entity;

use App\Repository\BookingsServicesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingsServicesRepository::class)]
class BookingsServices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options:['default'=>'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $reservationStartsAt = null;

    #[ORM\Column(options:['default'=>'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $reservationEndsAt = null;

    #[ORM\ManyToOne(inversedBy: 'bookingsServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bookings $bookings = null;

    #[ORM\ManyToOne(inversedBy: 'bookingsServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Services $services = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationStartsAt(): ?\DateTimeImmutable
    {
        return $this->reservationStartsAt;
    }

    public function setReservationStartsAt(\DateTimeImmutable $reservationStartsAt): static
    {
        $this->reservationStartsAt = $reservationStartsAt;

        return $this;
    }

    public function getReservationEndsAt(): ?\DateTimeImmutable
    {
        return $this->reservationEndsAt;
    }

    public function setReservationEndsAt(\DateTimeImmutable $reservationEndsAt): static
    {
        $this->reservationEndsAt = $reservationEndsAt;

        return $this;
    }

    public function getBookings(): ?Bookings
    {
        return $this->bookings;
    }

    public function setBookings(?Bookings $bookings): static
    {
        $this->bookings = $bookings;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): static
    {
        $this->services = $services;

        return $this;
    }
}
