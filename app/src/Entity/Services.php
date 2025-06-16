<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(length: 100)]
    private ?string $serviceType = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $serviceDescription = null;


    #[ORM\ManyToOne(inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categories = null;

    /**
     * @var Collection<int, Offerings>
     */
    #[ORM\ManyToMany(targetEntity: Offerings::class, mappedBy: 'services')]
    private Collection $offerings;

    /**
     * @var Collection<int, BookingsServices>
     */
    #[ORM\OneToMany(targetEntity: BookingsServices::class, mappedBy: 'services')]
    private Collection $bookingsServices;


    public function __construct()
    {
        $this->offerings = new ArrayCollection();
        $this->bookingsServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getServiceType(): ?string
    {
        return $this->serviceType;
    }

    public function setServiceType(string $serviceType): static
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    public function getServiceDescription(): ?string
    {
        return $this->serviceDescription;
    }

    public function setServiceDescription(string $serviceDescription): static
    {
        $this->serviceDescription = $serviceDescription;

        return $this;
    }

    

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Offerings>
     */
    public function getOfferings(): Collection
    {
        return $this->offerings;
    }

    public function addOffering(Offerings $offering): static
    {
        if (!$this->offerings->contains($offering)) {
            $this->offerings->add($offering);
            $offering->addService($this);
        }

        return $this;
    }

    public function removeOffering(Offerings $offering): static
    {
        if ($this->offerings->removeElement($offering)) {
            $offering->removeService($this);
        }

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
            $bookingsService->setServices($this);
        }

        return $this;
    }

    public function removeBookingsService(BookingsServices $bookingsService): static
    {
        if ($this->bookingsServices->removeElement($bookingsService)) {
            // set the owning side to null (unless already changed)
            if ($bookingsService->getServices() === $this) {
                $bookingsService->setServices(null);
            }
        }

        return $this;
    }

}
