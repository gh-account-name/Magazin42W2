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

    public function update(Request $request){

        $validation = Validator::make($request->all(),[
            'title' => ['required',],
        ],[
            'title.required' => 'Обязательное поле',
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $category = Categry::query()->where('id', $request->id)->first();
        $category->title = $request->title;
        $category->update();

        return redirect()->route('categoriesPage');
    }

    public function destroy(Request $request){
        Categry::query()->where('id', $request->id_category)->delete();
        return response()->json('Категория ' . $request->id_category . ' удалена', 200);
    }
}
