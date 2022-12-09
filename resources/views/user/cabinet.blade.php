@extends('layout.app')

@section('title')
    Личный кабинет
@endsection

@section('main')
    <div class="container">
        <h1 class="text-center m-5">Личный кабинет</h1>
        <div class="user-data row">
            <div class="user-avatar-login d-flex flex-wrap justify-content-center col-5">
                {{-- <img style="width: 50%;" class="p-3" src="{{asset('public/storage/public/user-icon.png')}}" alt="Avatar"> --}}
                <span class="d-flex justify-content-center align-items-center m-3" style="background: url('{{asset('public/storage/public/user-icon.png')}}') center no-repeat;background-size: cover; border-radius: 1000px; width: 300px; height: 300px;">
                    {{-- <img style="width: 100%;" src="https://wallpapers.com/images/hd/cool-picture-wolf-art-o0ixt449edz5dgpa.jpg" alt="Avatar"> --}}
                </span>
                <div class="user-login col-12 d-flex justify-content-center">
                    <p class="h2 fw-bold">{{Auth::user()->login}}</p>
                </div>
            </div>
            <div class="col-7 h3 d-flex flex-wrap align-items-center">
                <div class="row ">
                    <b class="w-auto p-0">Имя:&nbsp;</b><p class="w-auto p-0">{{Auth::user()->name}}</p>
                </div>
                <div class="row col-12">
                    <b class="w-auto p-0">Фамилия:&nbsp;</b><p class="w-auto p-0">{{Auth::user()->surname}}</p>
                </div>
                @if(Auth::user()->patronymic)
                <div class="row col-12">
                    <b class="w-auto p-0">Отчество:&nbsp;</b><p class="w-auto p-0">{{Auth::user()->patronymic}}</p>
                </div>
                @endif
                <div class="row col-12">
                    <b class="w-auto p-0">Email:&nbsp;</b><p class="w-auto p-0">{{Auth::user()->email}}</p>
                </div>
                <div class="row col-12">
                    <a href="{{route('editUser')}}" class="btn btn-warning col-4">Изменить данные</a>
                </div>
            </div>
        </div>
    </div>
@endsection
