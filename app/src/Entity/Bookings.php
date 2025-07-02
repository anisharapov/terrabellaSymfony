<?php

namespace App\Entity;

use App\Repository\BookingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $reservationNumber = null;

    #[ORM\Column(options:['default'=>'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $bookedAt = null;

    #[ORM\Column]
    private ?bool $reservationStatus = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    /**
     * @var Collection<int, BookingsServices>
     */
    #[ORM\OneToMany(targetEntity: BookingsServices::class, mappedBy: 'bookings')]
    private Collection $bookingsServices;

    public function __construct()
    {
        $this->bookingsServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationNumber(): ?int
    {
        return $this->reservationNumber;
    }

    public function setReservationNumber(int $reservationNumber): static
    {
        $this->reservationNumber = $reservationNumber;

        return $this;
    }

    public function getBookedAt(): ?\DateTimeImmutable
    {
        return $this->bookedAt;
    }

    public function setBookedAt(\DateTimeImmutable $bookedAt): static
    {
        $this->bookedAt = $bookedAt;

        return $this;
    }

    public function isReservationStatus(): ?bool
    {
        return $this->reservationStatus;
    }

    public function setReservationStatus(bool $reservationStatus): static
    {
        $this->reservationStatus = $reservationStatus;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, BookingsServices>
     */
    public function getBookingsServices(): Collection
    {
        return $this->bookingsServices;
    }

    public function addBookingsService(BookingsServices $bookingsService): static
    {
        if (!$this->bookingsServices->contains($bookingsService)) {
            $this->bookingsServices->add($bookingsService);
            $bookingsService->setBookings($this);
        }

        return $this;
    }

    public function removeBookingsService(BookingsServices $bookingsService): static
    {
        if ($this->bookingsServices->removeElement($bookingsService)) {
            // set the owning side to null (unless already changed)
            if ($bookingsService->getBookings() === $this) {
                $bookingsService->setBookings(null);
            }
        }

        return $this;
    }

}
