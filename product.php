<?php


class Product
{
    private  $id;
    private  $title;
    private  $price;
    private  $availableQuantity;

    public function __construct($id, $title, $price, $availableQuantity)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;
    }

   
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;
    }

    public function addToCart( $cart,  $quantity)
    {
        return $cart->addProduct($this, $quantity);
    }


    public function removeFromCart($cart)
    {
        return $cart->removeProduct($this);
    }
}