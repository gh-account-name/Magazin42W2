<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        $validation = Validator::make($request->all(), [
            'name'=>['required', 'regex:/[А-Яа-яЁё]/u'],
            'surname'=>['required', 'regex:/[А-Яа-яЁё]/u'],
            'patronymic'=>['regex:/[А-Яа-яЁё]/u',  'nullable'],
            'email'=>['required', 'email:frc', 'unique:users'],
            'login'=>['required', 'regex:/[A-Za-zА-ЯЁа-яё0-9]/u'],
            'password'=>['required', 'min:6', 'max:12', 'confirmed'],
            'rules'=>['required'],
        ], [
            'name.required'=>'Это обязательное поле',
            'name.regex'=>'Допускается только кирилица',
            'surname.required'=>'Это обязательное поле',
            'surname.regex'=>'Допускается только кирилица',
            'patronymic.regex'=>'Допускается только кирилица',
            'email.required'=>'Это обязательное поле',
            'email.email'=>'Пример заполнения: example@email.com',
            'email.unique'=>'Данный адрес уже зарегистрирован',
            'login.required'=>'Это обязательное поле',
            'login.regex'=>'Не допускается использование спецсимволов',
            'login.unique'=>'Данный логин уже используется',
            'password.required'=>'Это обязательное поле',
            'password.min'=>'Минимальная длина пароля: 6 символов',
            'password.max'=>'Максимальная длина пароля: 12 символов',
            'password.confirmed'=>'Пароли не совпадают',
            'rules.required'=>'Нам нужно ваше согласие на обработку данных',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(), 400);
        }
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->patronymic = $request->patronymic;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = md5($request->password);
        $user->save();

        return redirect()->route('authPage')->with('success', 'Вы успешно зарегистрировались');
    }

    public function auth(Request $request){
        $validation = Validator::make($request->all(), [
            'login'=>['required', 'regex:/[A-Za-zА-ЯЁа-яё0-9]/u'],
            'password'=>['required', 'min:6', 'max:12'],
         ], [
             'login.required'=>'Это обязательное поле',
             'login.regex'=>'Не допускается использование спецсимволов',
             'password.required'=>'Это обязательное поле',
             'password.min'=>'Минимальная длина пароля: 6 символов',
             'password.max'=>'Максимальная длина пароля: 12 символов',
         ]);

         if ($validation->fails()){
            return response()->json($validation->errors(), 400);
         }

         $user = User::query()->where('login', $request->login)->where('password', md5($request->password))->first();

         if($user){
            Auth::login($user);
            if($user->role === 'admin'){
                return redirect()->route('categoriesPage');
            } else {
                return redirect()->route('cabinetPage');
            }
         } else {
            return response()->json('Неверный логин или пароль', 403);
         }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('aboutUs');
    }
}
