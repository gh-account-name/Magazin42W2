@extends('layout.app')

@section('title')
    Редактирование товара
@endsection

@section('main')
    <div class="container d-flex flex-column align-items-center" id="editProductPage">
        <h2 class="mt-5">Редактировать продукт №{{$product->id}}</h2>

        <form @submit.prevent="UpdateProduct" id="editProductForm" style="padding: 40px;" class="col-6" method="post" enctype="multipart/form-data">

            <input type="text" class="visually-hidden" name="product_id" value="{{$product->id}}">

            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" :class="errors.title ? 'is-invalid' : ''" id="title" name="title" value="{{$product->title}}">
                <div :class="errors.title ? 'invalid-feedback' : '' " v-for="error in errors.title">
                    @{{error}}
                </div>
            </div>

            <select id="category" name="category" class="form-select mt-4" :class="errors.category ? 'is-invalid' : ''" aria-label="Default select example">
                <option selected disabled>Категория</option>
                <option v-for="category in categories" :selected="`{{$product->categry_id}}`==category.id" :value="category.id">@{{category.title}}</option>
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
                <input class="form-control" :class="errors.age ? 'is-invalid' : ''" type="date" id="age" name="age" value="{{$product->age}}">
                <div :class="errors.age ? 'invalid-feedback' : '' " v-for="error in errors.age">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="antagonist" class="form-label">Антагонист</label>
                <input class="form-control" :class="errors.antagonist ? 'is-invalid' : ''" type="text" id="antagonist" name="antagonist" value="{{$product->antagonist}}">
                <div :class="errors.antagonist ? 'invalid-feedback' : '' " v-for="error in errors.antagonist">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input class="form-control" :class="errors.price ? 'is-invalid' : ''" type="text"  id="price" name="price" value="{{$product->price}}">
                <div :class="errors.price ? 'invalid-feedback' : '' " v-for="error in errors.price">
                    @{{error}}
                </div>
            </div>

            <div class="mb-3">
                <label for="count" class="form-label">Количество товара в наличии</label>
                <input class="form-control" :class="errors.count ? 'is-invalid' : ''" type="number" id="count" name="count" value="{{$product->count}}">
                <div :class="errors.count ? 'invalid-feedback' : '' " v-for="error in errors.count">
                    @{{error}}
                </div>
            </div>

            <div class="row justify-content-center"><button type="submit" class="col-5 btn btn-primary mt-3">Редактировать</button></div>
        </form>
    </div>

    <script>
        const EditProduct = {

            data(){
                return{
                    errors: [],
                    categories:[],
                }
            },

            methods:{
                async UpdateProduct(){
                    const form = document.querySelector('#editProductForm');
                    const form_data = new FormData(form);
                    const response = await fetch('{{route('updateProduct')}}', {
                        method: 'post',
                        headers:{
                            "X-CSRF-TOKEN": '{{csrf_token()}}'
                        },
                        body: form_data,
                    });

                    if (response.status === 400){
                        this.errors = await response.json();
                    }

                    if (response.status === 200){
                        window.location = response.url;
                    }

                    // const inputs = document.querySelectorAll('#productForm .form-control');
                    // inputs.forEach(input => {
                    //     input.value = '';
                    // });
                    // document.querySelector('#productForm .form-select').value = 'Категория';

                },
                async getCategories(){
                    const response = await fetch('{{route('getCategories')}}');
                    const data = await response.json();
                    this.categories = data.categories;
                },

            },
            mounted(){
                this.getCategories();
            },
        }
        Vue.createApp(EditProduct).mount('#editProductPage');
    </script>
@endsection
