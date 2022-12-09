<?php

namespace App\Http\Controllers;

use App\Models\Categry;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function registrationPage(){
        return view('user.registration');
    }

    public function authPage(){
        return view('user.auth');
    }

    public function categoriesPage(){
        return view('admin.categories');
    }

    public function cabinetPage(){
        return view('user.cabinet');
    }

    public function editCategoryPage(Categry $category){
        return view('admin.editCategory', ['category'=>$category]);
    }

    public function productsPage(){
        return view('admin.products');
    }

    public function editProductPage(Product $product){
        return view('admin.editProduct', ['product'=>$product]);
    }

    public function catalogPage(){
        return view('product.catalog');
    }

    public function cartPage(){
        return view('user.cart');
    }

    public function adminOrdersPage(){
        return view('admin.orders');
    }

    public function userOrdersPage(){
        return view('user.orders');
    }

    public function productPage(Product $product){
        return view('product.product', ['product'=>$product]);
    }

    public function contactsPage(){
        return view('contacts');
    }
}
