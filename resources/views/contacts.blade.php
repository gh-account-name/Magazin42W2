@extends('layout.app')

@section('title')
Где нас найти?
@endsection

@section('main')
    <div class="container">
        <h1 class="m-5 text-center">Где нас найти?</h1>
        <div class="map col-12 d-flex justify-content-center">
            <img class="col-10" src="{{asset('public/storage/public/map.jpg')}}" alt="map">
        </div>
        <div class="col-12 mt-5 h4 d-flex flex-wrap align-items-center justify-content-center">
            <div class="row col-8">
                <b class="w-auto p-0">Наш адрес:&nbsp;</b><p class="w-auto p-0">Нижний Новгород, улица Тимирязева, 29Б</p>
            </div>
            <div class="row col-8">
                <b class="w-auto p-0">Звоните нам по любым вопросам:&nbsp;</b><p class="w-auto p-0">+7 (995) 001-34-23</p>
            </div>
            <div class="row col-8">
                <b class="w-auto p-0">Email:&nbsp;</b><p class="w-auto p-0">comixcom@mail.com</p>
            </div>
        </div>
    </div>
    </div>
@endsection