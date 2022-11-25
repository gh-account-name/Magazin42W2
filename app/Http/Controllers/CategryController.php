<?php

namespace App\Http\Controllers;

use App\Models\Categry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategryController extends Controller
{
    public function addCategory(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => ['required', 'regex:/[A-Za-zА-Яа-яЁё]/u'],
        ],[
            'title.required' => 'Обязательное поле',
            'title.regex' => 'Цифры не допускаются',
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $category = new Categry();
        $category->title = $request->title;
        $category->save();

        return response()->json('Категория успешно добавлена', 200);
    }

    public function getCategories(){
        $categories = Categry::all();
        return response()->json([
            'categories'=>$categories,
        ], 200);
    }

    public function update(Request $request, Categry $category){
        $category->title = $request->title;
        $category->update();
        return redirect()->route('categoriesPage');
    }

    public function destroy(Categry $category){
        $category->delete();
        return redirect()->back();
    }
}
