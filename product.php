<?php


class Product
{
    private  $id;
    private  $title;
    private  $price;
    private  $availableQuantity;
    private  $product;
    private  $quantity;


    public function __construct($id=null, $title=null, $price=null, $availableQuantity=null, $product=null, $quantity=null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
        $this->product = $product;
        $this->quantity = $quantity;
    }
    
   
   

   
    public function getProduct()
    {
        return $this->product;
    }

   
    public function setProduct($product)
    {
        $this->product = $product;
    }

    
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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

    public function addProduct( $product, $quantity)
    {
        // find product in cart
        $cartItem = $this->findCartItem($product->getId());
        if ($cartItem === null){
            $cartItem = new Product($product, 0);
            $this->items[$product->getId()] = $cartItem;
        }
        return $cartItem;
    } 

     private function findCartItem($productId)
    {
        return $this->items[$productId] ?? null;
    }

    public function increaseQuantity($amount = 1)
    {
        if ($this->getQuantity() + $amount > $this->getProduct()){
            throw new Exception("Product quantity can not be more than ".$this->getProduct());
        } 
       $this->quantity += $amount; 
    }
    public function decreaseQuantity($amount = 1)
    {
        if ($this->getQuantity() - $amount < 1){
            throw new Exception("Product quantity can not be less than 1");
        }
        $this->quantity -= $amount;
    }


    public function removeFromCart($cart)
    {
        return $cart->removeProduct($this);
    }
}