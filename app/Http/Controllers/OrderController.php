<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
}
