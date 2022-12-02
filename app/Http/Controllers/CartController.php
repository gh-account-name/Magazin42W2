<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request){

        $product = Product::query()->where('id', $request->product_id)->first();

        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'новый')
            ->firstOrCreate(['user_id'=>Auth::id()], ['status'=>'новый']);

        $cart = Cart::query()
            ->where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->firstOrCreate(['order_id'=>$order->id], ['product_id'=>$product->id]);

        if($cart->count){

            if($product->count > $cart->count){
                $cart->count += 1;
                $cart->summ += $product->price;
                $order->summ += $product->price;
                $cart->save();
                $order->save();

                return response()->json('Товар добавлен в корзину', 200);
            } else {
                return response()->json('Товара нет в таком количестве', 400);
            }

        } else {
            $cart->count = 1;
            $cart->summ = $product->price;
            $order->summ += $cart->summ;
            $cart->save();
            $order->save();

            return response()->json('Товар добавлен в корзину', 200);
        }

    }

    public function getCarts(){

        $order = Order::query()->where('user_id', Auth::id())->where('status', 'новый')->firstOrNew();

        $carts = Cart::query()->where('order_id', $order->id)->with('product')->get();

        return response()->json([
            'carts'=>$carts,
            'order'=>$order,
        ], 200);
    }

    public function removeFromCart(Request $request){

        $product = Product::query()->where('id', $request->product_id)->first();

        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'новый')
            ->first();

        $cart = Cart::query()
            ->where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cart->count > 1){
            $cart->count -= 1;
            $cart->summ -= $product->price;
            $order->summ -= $product->price;
            $cart->update();
            $order->update();
            return response()->json('', 200);
        } else {
            $order->summ -= $cart->summ;
            $order->update();
            $cart->delete();
            return response()->json('Товар удалён', 200);
        }
    }

    public function deleteFromCart(Request $request){
        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'новый')
            ->first();

        $cart = Cart::query()
            ->where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->first();

        $order->summ -= $cart->summ;
        $order->update();
        $cart->delete();
        return response()->json('Товар удалён', 200);

    }
}
