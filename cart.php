<?php

require_once('product.php');

class Cart
{
    
    private  $items = [];
    private  $product;
    private  $quantity;

   
    public function __construct($product=null, $quantity=null)
    {
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

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
    
    public function addProduct( $product, $quantity)
    {
        // find product in cart
        $cart = $this->findCartItem($product->getId());
        if ($cart === null){
            $cart = new Cart($product, 0);
            $this->items[$product->getId()] = $cart;
        }
        $cart->increaseQuantity($quantity);
        return $cart;
    }

    private function findCartItem($productId)
    {
        return $this->items[$productId] ?? null;
    }

    public function removeProduct( $product)
    {
        unset($this->items[$product->getId()]);
    }

    public function increaseQuantity($amount = 1)
    {
        if ($this->getQuantity() + $amount > $this->getProduct()->getAvailableQuantity()){
            throw new Exception("Product quantity can not be more than ".$this->getProduct()->getAvailableQuantity());
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

    
    public function getTotalQuantity()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getQuantity();
        }
        return $sum;
    }

   
    public function getTotalSum()
    {
        $totalSum = 0;
        foreach ($this->items as $item) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }

        return $totalSum;
    }
}