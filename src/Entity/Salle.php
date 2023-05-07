<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $disponible = null;

    #[ORM\Column]
    private ?int $nbPlaces = null;

    #[ORM\ManyToMany(targetEntity: Materiel::class, inversedBy: 'salles')]
    private Collection $materiel;

    #[ORM\ManyToMany(targetEntity: Logiciel::class, inversedBy: 'salles')]
    private Collection $logiciel;

    #[ORM\ManyToMany(targetEntity: Ergonomie::class, inversedBy: 'salles')]
    private Collection $ergonomie;

    #[ORM\OneToMany(mappedBy: 'salle', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prixHebdo = null;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
        $this->logiciel = new ArrayCollection();
        $this->ergonomie = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * @return Collection<int, Materiel>
     */
    public function getMateriel(): Collection
    {
        return $this->materiel;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiel->contains($materiel)) {
            $this->materiel->add($materiel);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        $this->materiel->removeElement($materiel);

        return $this;
    }

    /**
     * @return Collection<int, Logiciel>
     */
    public function getLogiciel(): Collection
    {
        return $this->logiciel;
    }

    public function addLogiciel(Logiciel $logiciel): self
    {
        if (!$this->logiciel->contains($logiciel)) {
            $this->logiciel->add($logiciel);
        }

        return $this;
    }

    public function removeLogiciel(Logiciel $logiciel): self
    {
        $this->logiciel->removeElement($logiciel);

        return $this;
    }

    /**
     * @return Collection<int, Ergonomie>
     */
    public function getErgonomie(): Collection
    {
        return $this->ergonomie;
    }

    public function addErgonomie(Ergonomie $ergonomie): self
    {
        if (!$this->ergonomie->contains($ergonomie)) {
            $this->ergonomie->add($ergonomie);
        }

        return $this;
    }

    public function removeErgonomie(Ergonomie $ergonomie): self
    {
        $this->ergonomie->removeElement($ergonomie);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setSalle($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getSalle() === $this) {
                $reservation->setSalle(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrixHebdo(): ?float
    {
        return $this->prixHebdo;
    }

    public function setPrixHebdo(float $prixHebdo): self
    {
        $this->prixHebdo = $prixHebdo;

        return $this;
    }
}
