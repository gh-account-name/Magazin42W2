<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function makeAnOrder(Request $request){
        $validation = Validator::make($request->all(), [
            'password'=>['required', 'min:6', 'max:12'],
        ], [
            'login.required'=>'Это обязательное поле',
            'login.regex'=>'Не допускается использование спецсимволов',
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        if (md5($request->password) === Auth::user()->password){
            $order = Order::query()
                ->where('user_id', Auth::id())
                ->where('status', 'новый')
                ->first();

            $order->status = 'в обработке';
            $order->update();

            return response()->json('Ваш заказ обрабатывается', 200);
        } else {
            return response()->json('Неверный пароль', 403);
        }
    }

    public function getOrders(){
        $orders_admin = Order::query()->where('status', '!=', 'новый')->with('user')->with('carts.product')->get();
        $orders_user = Order::query()->where('status', '!=', 'новый')->where('id', Auth::id())->with('user')->with('carts.product')->get();
        return response()->json([
            'orders_admin' => $orders_admin,
            'orders_user' => $orders_user,
        ]);
    }

    public function confirmOrder(Request $request){
        $order = Order::query()->where('id', $request->id)->first();
        $carts = Cart::query()->where('order_id', $order->id)->get();

        foreach ($carts as $cart){
            $product = Product::query()->where('id', $cart->product_id)->first();

            if ($cart->count <= $product->count){
                $product->count -= $cart->count;
                $product->update();
            } else {
                return response()->json('На складе не хватает товара №' . $cart->product_id, 400);
            }
        }

        $order->status = 'подтверждён';
        $order->update();
        return response()->json('Вы подтвердили заказ №' . $order->id, 200);

    }

    public function rejectOrder(Request $request){
        $order = Order::query()->where('id', $request->order_id)->first();
        $order->status = 'отклонён';
        $order->comment = $request->comment;
        $order->update();
        return redirect()->back();
    }
}
