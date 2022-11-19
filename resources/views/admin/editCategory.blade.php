@extends('layout.app')

@section('title')
    Редактировать категорию
@endsection

@section('main')
    <div class="container d-flex flex-column align-items-center">
        <h2 class="mt-5">Редактировать категорию</h2>
        <form action="{{route('updateCategory',['category'=>$category])}}" style="padding: 40px;" class="col-4" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="title" class="form-label">Название категории</label>
                <input class="form-control" type="text" id="title" name="title" required value="{{$category->title}}">
            </div>
            <div class="row justify-content-center"><button type="submit" class="col-5 btn btn-primary mt-3">Редактировать</button></div>
        </form>
    </div>
@endsection
