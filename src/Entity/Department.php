<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message : "Vul iets in!")]
    private  $name ;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $budget = null;

    #[ORM\OneToMany(mappedBy: 'department', targetEntity: Employeee::class)]
    private Collection $employeees;

    public function __construct()
    {
        $this->employeees = new ArrayCollection();
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return Collection<int, Employeee>
     */
    public function getEmployeees(): Collection
    {
        return $this->employeees;
    }

    public function addEmployeee(Employeee $employeee): self
    {
        if (!$this->employeees->contains($employeee)) {
            $this->employeees->add($employeee);
            $employeee->setDepartment($this);
        }

        return $this;
    }

    public function removeEmployeee(Employeee $employeee): self
    {
        if ($this->employeees->removeElement($employeee)) {
            // set the owning side to null (unless already changed)
            if ($employeee->getDepartment() === $this) {
                $employeee->setDepartment(null);
            }
        }

        return $this;
    }
}
