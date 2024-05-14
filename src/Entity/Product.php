<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $productid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $package = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $offerprice = null;

    #[ORM\Column]
    private ?float $tax_percentage = null;

    #[ORM\Column(length: 500)]
    private ?string $mediaurl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductid(): ?string
    {
        return $this->productid;
    }

    public function setProductid(string $productid): static
    {
        $this->productid = $productid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPackage(): ?string
    {
        return $this->package;
    }

    public function setPackage(string $package): static
    {
        $this->package = $package;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOfferprice(): ?int
    {
        return $this->offerprice;
    }

    public function setOfferprice(int $offerprice): static
    {
        $this->offerprice = $offerprice;

        return $this;
    }

    public function getTaxPercentage(): ?int
    {
        return $this->tax_percentage;
    }

    public function setTaxPercentage(int $tax_percentage): static
    {
        $this->tax_percentage = $tax_percentage;

        return $this;
    }

    /*
    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOfferprice(): ?float
    {
        return $this->offerprice;
    }

    public function setOfferprice(float $offerprice): static
    {
        $this->offerprice = $offerprice;

        return $this;
    }

    public function getTaxPercentage(): ?float
    {
        return $this->tax_percentage;
    }

    public function setTaxPercentage(float $tax_percentage): static
    {
        $this->tax_percentage = $tax_percentage;

        return $this;
    }
    */

    public function getMediaurl(): ?string
    {
        return $this->mediaurl;
    }

    public function setMediaurl(string $mediaurl): static
    {
        $this->mediaurl = $mediaurl;

        return $this;
    }
}
