<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\ManyToMany(targetEntity: Orders::class, inversedBy: 'products')]
    private Collection $Orders;

    public function __construct()
    {
        $this->Orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

//    /**
//     * @return Collection<int, Orders>
//     */
//    public function getOrders(): Collection
//    {
//        return $this->Orders;
//    }

    public function addOrder(Orders $order): self
    {
        if (!$this->Orders->contains($order)) {
            $this->Orders->add($order);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        $this->Orders->removeElement($order);

        return $this;
    }

    public function __toString() : string
    {
        return $this->getName();
    }
}
