@extends('layout.app')

@section('title')
    Админ панель
@endsection

@section('main')
    <div class="container d-flex flex-column align-items-center">
        <h2 class="text-white mt-5">Создать категорию</h2>
        <form action="{{route('addCategory')}}" style="padding: 40px;" class="col-4" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="title" class="form-label text-white">Название категории</label>
                <input class="form-control" type="text" id="title" name="title" required>
            </div>
            <div class="row justify-content-center"><button type="submit" class="col-5 btn btn-primary mt-3">Создать</button></div>
        </form>
    </div>

    <div class="d-flex justify-content-center flex-column align-items-center m-5">
        <h2 class="m-5 text-white">Категории</h2>
        <div class="categoriesTable col-8">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-white" scope="col">#</th>
                    <th class="text-white" scope="col">Название</th>
                    <th scope="col" class="col-3 text-center text-white">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <th class="text-white" scope="row">{{$key+1}}</th>
                        <td class="text-white">{{$category->title}}</td>
                        <td class="d-flex justify-content-sm-around">
                            <a href="#"><button type="button" class="btn btn-success">Редактировать</button></a>
                            <form action="#" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center m-5">
        <a href="#" class="col-5 d-flex justify-content-center"><button class="col-5 btn btn-primary mt-3">Добавить товар</button></a>
    </div>
@endsection
