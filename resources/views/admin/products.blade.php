@extends('layout.app')

@section('title')
    Продукты
@endsection

@section('main')
    <div class="container d-flex flex-column align-items-center" id="productsPage">
        <h2 class="mt-5">Добавить продукт</h2>
        <form action="" style="padding: 40px;" class="col-6" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" :class="errors.title ? 'is-invalid' : ''" id="title" name="title">
                <div class="invalid-feedback">
                    <div :class="errors.title ? 'invalid-feedback' : '' " v-for="error in errors.title">
                        @{{error}}
                    </div>
                </div>
            </div>

            <select id="category" name="category" class="form-select mt-4" :class="errors.category ? 'is-invalid' : ''" aria-label="Default select example">
                <option selected disabled>Категория</option>
                <option v-for="category in categories" value="category.id">@{{category.title}}</option>
            </select>
            <div :class="errors.category ? 'invalid-feedback' : '' " v-for="error in errors.category">
                @{{error}}
            </div>

            <div class="mb-3 mt-3">
                <label for="img" class="form-label">Картинка</label>
                <input type="file" class="form-control" :class="errors.img ? 'is-invalid' : ''" id="img" name="img">
                <div :class="errors.img ? 'invalid-feedback' : '' " v-for="error in errors.img">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Дата издания</label>
                <input class="form-control" :class="errors.age ? 'is-invalid' : ''" type="date" id="age" name="age">
                <div :class="errors.age ? 'invalid-feedback' : '' " v-for="error in errors.age">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="antagonist" class="form-label">Антагонист</label>
                <input class="form-control" :class="errors.antagonist ? 'is-invalid' : ''" type="text" id="antagonist" name="antagonist">
                <div :class="errors.antagonist ? 'invalid-feedback' : '' " v-for="error in errors.antagonist">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input class="form-control" :class="errors.price ? 'is-invalid' : ''" type="text"  id="price" name="price">
                <div :class="errors.price ? 'invalid-feedback' : '' " v-for="error in errors.price">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="count" class="form-label">Количество товара в наличии</label>
                <input class="form-control" :class="errors.count ? 'is-invalid' : ''" type="number" id="count" name="count">
                <div :class="errors.count ? 'invalid-feedback' : '' " v-for="error in errors.count">
                    @{{error}}
                </div>
            </div>

            <div class="row justify-content-center"><button type="submit" class="col-5 btn btn-primary mt-3">Добавить</button></div>
        </form>

        <div class="products">
            <h1 class="text-center ">Товары</h1>

            <div v-for="product in products" class="products row row-cols-1 row-cols-md-3 g-5 mt-4">

                    <div class="col d-flex justify-content-center">
                        {{--                    <a href="#" class="card" style="text-decoration: none; display: flex; background-color: white; flex-direction: column; width: 280px; height:380px; padding: 20px; border-radius: 20px ; align-items: center; margin-top:50px ;box-shadow: 2px 2px 5px black">--}}
                        {{--                        <img style="height: 80%;" src="{{$product->img}}" alt="product" >--}}
                        {{--                        <p style="font-size: 18px; font-weight: bold; color: black; margin: 0" class=" text-center mt-2">{{$product->title}}</p>--}}
                        {{--                        <p style="font-size: 18px; font-weight: bold; color: black; margin: 0" class="text-center">{{$product->price}} р.</p>--}}
                        {{--                    </a>--}}
                        <div class="card" style="width: 300px; box-shadow: 0 0 10px black; text-decoration: none;">
                            <img src="" class="card-img-top" alt="..." style="height: 100%">
                            <div class="card-body" style="position: relative">
                                <a href="" class="text-decoration-none"><h5 class="card-title text-center text-black" style="height: 50px"></h5></a>
                                <p class="card-text text-black"> руб.</p>
                                <p class="card-text"
                                >Количество на скаладе:</p>
                                <p class="card-text text-black">Категория:</p>
                                <div class="buttons d-flex justify-content-between mt-3 w-100">
                                    <a href=""><button type="button" class="btn btn-warning" style="font-size: 12px">Редактировать</button></a>
                                    <form action="" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <script>
        const Products = {
            data(){
                return {
                    errors:[],
                    message:'',
                    categories:[],
                    products:[],
                }
            },

            methods:{
                async AddProduct(){

                }
            }
        }
        Vue.createApp(Products).mount('#productsPage');
    </script>

@endsection
