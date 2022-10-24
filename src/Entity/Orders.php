<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Sum = null;

    #[ORM\Column]
    private ?int $Status = null;

    #[ORM\ManyToMany(targetEntity: Products::class, mappedBy: 'Orders')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSum(): ?float
    {
        $result = 0;
        foreach ($this->products as $item)
        {
            $result += $item->getPrice();
        }
        return $result;
    }

    public function getCount() : int
    {
        return $this->products->count();
    }

    public function setSum(float $Sum): self
    {
        $this->Sum = $Sum;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->Status;
    }

    public function setStatus(int $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addOrder($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeOrder($this);
        }

        return $this;
    }

    public function getPriceForOne() : string
    {
        $result = '';
        foreach ($this->products as $item)
        {
            $result .= $item->getName() . ' - ' . $item->getPrice() . '; ';
        }
        return $result;
    }

}
