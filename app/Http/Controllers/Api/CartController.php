<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (Cart::where('user_id', $request->user_id)->exists()) {
            return $this->updateCart($request, $request->user_id);
        }
        $cart = new Cart();
        $cart->user_id = $request->user_id;
        $cart->save();
        return $this->updateCart($request, $request->user_id);
    }
    public function getCart($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->exists();
        if(!$cart)
        {
            return response()->json(
                [
                    'items'=>'No items Found',
                    'count'=>0
                ],
                404);
        }
        $cart = Cart::where('user_id', $user_id)->first();

        return response()->json(
            [
                'items'=>$cart->cartItems()->with(['product','product.category'])->get(),
                'count' => $cart->cartItems->count()
            ]);
    }
    public function updateCart(Request $request,$user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        $cartItem = CartItem::where('product_id', $request->product_id)
            ->where('cart_id', $cart->id)
            ->exists();
        if ($cartItem) {
            $cartItem = CartItem::where('product_id', $request->product_id)->first();
            return $this->updateItem($request, $cartItem, $cart);
        }
        $cartItem = new CartItem();
        $cartItem->cart_id =  $cart->id;
        $cartItem->product_id = $request->product_id;
        $cartItem->quantity = $request->quantity ? $request->quantity : 1;
        $cartItem->save();
        return response()->json($cart->cartItems);
    }
    public function removeFromCart(Request $request,$user_id)
    {
        if(!$user_id || !$request->product_id)
        {
            return response()->json('user_id or product_id is Empty');
        }
        $cart_id = Cart::where('user_id', $user_id)
        ->first()
        ->id;
        $ItemToRemove = CartItem::where('product_id', $request->product_id)
        ->where('cart_id', $cart_id)
        ->first();
        $ItemToRemove->delete();
        return response()->json('deleted');
    }
    private function updateItem(Request $request, CartItem $cartItem, Cart $cart)
    {
        $cartItem->quantity = $request->quantity ? $request->quantity : $cartItem->quantity;
        $cartItem->update();
        return response()->json($cart->cartItems);
    }
}
