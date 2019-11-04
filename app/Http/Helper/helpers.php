<?php

if (!function_exists('showCartQuantity')) {
    function showCartQuantity() {
        $quantity = 0;

        if (auth()->check()) {
            $currentUser = auth()->user();
            $newOrder = $currentUser->orders
                ->where('status', 1)
                ->first();

            $quantity = $newOrder ? $newOrder->products->sum('pivot.quantity') : 0;
        }

        return $quantity;
    }
}
