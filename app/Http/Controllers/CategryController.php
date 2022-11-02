<?php

namespace App\Http\Controllers;

use App\Models\Categry;
use Illuminate\Http\Request;

class CategryController extends Controller
{
    public function addCategory(Request $request){
        $category = new Categry();
        $category->title = $request->title;
        $category->save();
        return redirect()->route('adminPage');
    }
}
