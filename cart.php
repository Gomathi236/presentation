<?php


class Cart
{
    
    private  $items = [];

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
        $cartItem = $this->findCartItem($product->getId());
        if ($cartItem === null){
            $cartItem = new CartItem($product, 0);
            $this->items[$product->getId()] = $cartItem;
        }
        $cartItem->increaseQuantity($quantity);
        return $cartItem;
    }

    private function findCartItem($productId)
    {
        return $this->items[$productId] ?? null;
    }

    public function removeProduct( $product)
    {
        unset($this->items[$product->getId()]);
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