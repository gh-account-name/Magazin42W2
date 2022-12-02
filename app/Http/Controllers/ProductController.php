<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => ['required'],
            'img' => ['required', 'mimes:png,jpg,jpeg,bmp', 'max:1024'],
            'category' => ['required'],
            'price' => ['required', 'numeric', 'regex:/^\d*$|^\d*\.\d{1,2}$/'],
            'count' => ['required', 'numeric'],
        ], [
            'title.required' => 'Обязательное поле для заполнения',
            'title.regex' => 'Поле содержит только кирилицу',
            'img.required' => 'Обязательное поле для заполнения',
            'img.mimes' => 'Допустимое разрешение: png, jpg, jpeg',
            'img.max' => 'Размер файла не должен превышать 1Мб',
            'category.required' => 'Укажите категорию',
            'price.required' => 'Обязательное поле для заполнения',
            'price.numeric' => 'Поле должно быть числовым',
            'price.regex' => 'Укажите цену в рублях',
            'count.required' => 'Обязательное поле для заполнения',
            'count.numeric' => 'Поле должно быть числовым',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $path_img = '';
        if($request->file('img')){
            $path_img = $request->file('img')->store('public/img');
        }

        $product = new Product();
        $product->title = $request->title;
        $product->categry_id = $request->category;
        $product->img = '/storage/' . $path_img;
        $product->age = $request->age;
        $product->age = $request->age;
        $product->antagonist = $request->antagonist;
        $product->price = $request->price;
        $product->count = $request->count;

        $product->save();

        return response()->json('Товар добавлен', 200);
    }

    public function getProducts(){
        $products_admin = Product::with('categry')->orderByDesc('created_at')->get();

        $products_catalog = Product::query()->with('categry')->where('count', '!=', 0)->orderByDesc('created_at')->get();

        $products_slider = Product::query()->with('categry')->where('count', '!=', 0)->orderByDesc('created_at')->limit(5)->get();

        return response()->json([
            'products_admin'=> $products_admin,
            'products_catalog' => $products_catalog,
            'products_slider' => $products_slider,
        ], 200);
    }

    public function updateProduct(Request $request){
        dd($request);
        $validation = Validator::make($request->all(),[
            'title' => ['required'],
            'img' => ['mimes:png,jpg,jpeg,bmp', 'max:1024'],
            'category' => ['required'],
            'price' => ['required', 'numeric', 'regex:/^\d*$|^\d*\.\d{1,2}$/'],
            'count' => ['required', 'numeric'],
        ], [
            'title.required' => 'Обязательное поле для заполнения',
            'title.regex' => 'Поле содержит только кирилицу',
            'img.mimes' => 'Допустимое разрешение: png, jpg, jpeg',
            'img.max' => 'Размер файла не должен превышать 1Мб',
            'category.required' => 'Укажите категорию',
            'price.required' => 'Обязательное поле для заполнения',
            'price.numeric' => 'Поле должно быть числовым',
            'price.regex' => 'Укажите цену в рублях',
            'count.required' => 'Обязательное поле для заполнения',
            'count.numeric' => 'Поле должно быть числовым',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $product = Product::query()->where('id', $request->product_id)->first();

        if($request->file('img')){
            $path_img = $request->file('img')->store('public/img');
            $product->img = '/storage/' . $path_img;
        }

        $product->title = $request->title;
        $product->categry_id = $request->category;
        $product->age = $request->age;
        $product->antagonist = $request->antagonist;
        $product->price = $request->price;
        $product->count = $request->count;

        $product->update();

        return redirect()->route('productsPage');
    }

    public function deleteProduct(Request $request){
        $product = Product::query()->where('id', $request->id)->delete();
        return response()->json('Товар ' . $request->id . ' удалён');
    }
}
