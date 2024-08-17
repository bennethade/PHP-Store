<?php
namespace App\Entity;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;


#[Entity]
#[Table('products')]
class Products
{



    #[Id, Column(type: "integer"), GeneratedValue(strategy: "IDENTITY")]
    public int $id;

    #[Column(type: "string", unique: true, nullable: false)]
    public string $sku;

    #[Column(type: "string",  nullable: false)]
     public string $product_name;

    #[Column(type: "integer", nullable: false)]
     public  $price;

    #[Column(type: "decimal", nullable: true)]
     public  $size;

    #[Column(type: "decimal", nullable: true)]
     public  $weight;


    #[Column(type: "decimal", nullable: true)]
     public   $height;

    #[Column(type: "decimal", nullable: true)]
     public  $length;

    #[Column(type: "decimal", nullable: true)]
     public  $width;

//    /**
//     * Products constructor.
//     * @param int $id
//     * @param string $sku
//     * @param string $product_name
//     * @param $price
//     * @param $size
//     * @param $weight
//     * @param $height
//     * @param $length
//     * @param $width
//     */
//    public function __construct(int $id, string $sku, string $product_name, $price, $size, $weight, $height, $length, $width)
//    {
//        $this->id = $id;
//        $this->sku = $sku;
//        $this->product_name = $product_name;
//        $this->price = $price;
//        $this->size = $size;
//        $this->weight = $weight;
//        $this->height = $height;
//        $this->length = $length;
//        $this->width = $width;
//    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getSku(): string
    {
        return $this->sku;
    }


    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }


    public function getProductName(): string
    {
        return $this->product_name;
    }


    public function setProductName(string $product_name): void
    {
        $this->product_name = $product_name;
    }


    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getSize(): int
    {
        return $this->size;
    }


    public function setSize(int $size): void
    {
        $this->size = $size;
    }


    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }


    public function getHeight(): int
    {
        return $this->height;
    }


    public function setHeight(int $height): void
    {
        $this->height = $height;
    }


    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }


    public function getWidth(): int
    {
        return $this->width;
    }


    public function setWidth(int $width): void
    {
        $this->width = $width;
    }





}



?>