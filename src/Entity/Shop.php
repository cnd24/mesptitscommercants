<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @ORM\ManyToMany(targetEntity=ShopCategory::class, mappedBy="shops")
     */
    private $shopCategories;

    public function __construct()
    {
        $this->shopCategories = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|ShopCategory[]
     */
    public function getShopCategories(): Collection
    {
        return $this->shopCategories;
    }

    public function addShopCategory(ShopCategory $shopCategory): self
    {
        if (!$this->shopCategories->contains($shopCategory)) {
            $this->shopCategories[] = $shopCategory;
            $shopCategory->addShop($this);
        }

        return $this;
    }

    public function removeShopCategory(ShopCategory $shopCategory): self
    {
        if ($this->shopCategories->removeElement($shopCategory)) {
            $shopCategory->removeShop($this);
        }

        return $this;
    }
}
