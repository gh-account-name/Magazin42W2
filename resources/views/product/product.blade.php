@extends('layout.app')

@section('title')
    {{$product->title}}
@endsection

@section('main')

    <style>
        /* .image{
            height: 50vh;
            display: flex;
            justify-content: center;
        }
        .image img{
            height: inherit;
        } */
        .details button {
            /* color: #ffc107 !important;
            background-color: #212529 !important;
            border-color: #212529 !important; */
            padding: 0.5rem 15% !important;
        }
    </style>

    <div class="container" id="productPage">
        <h1 class="text-center mt-5">{{$product->title}}</h1>

        <div v-if="message" class="row d-flex justify-content-center mt-5">
            <div class="col-4 text-center" :class="message ? 'alert alert-success': ''">
                @{{message}}
            </div>
        </div>

        <div v-if="message_danger" class="row d-flex justify-content-center mt-5">
            <div class="col-4 text-center" :class="message_danger ? 'alert alert-danger': ''">
                @{{message_danger}}
            </div>
        </div>

        <div class="content d-flex justify-content-between mt-5" style="padding: 0 10% 0 10%">
            <div class="image col-4 p-1" style="border: 0.4rem rgb(33,37,41) solid; border-radius: .5rem; height:fit-content">
                <img class="col-12" src="{{$product->img}}" alt="product">
            </div>
            <div class="details col-6" style="font-size: 24px">
                <p>Цена: {{$product->price}} руб.</p>
                <p>Категория: {{$product->categry->title}}</p>
                @if ($product->age)
                    <p>Дата публикции: {{$product->age}}</p>
                @endif
                @if ($product->antagonist)
                    <p>Антагонист: {{$product->antagonist}}</p>
                @endif
                <p>Осталось в наличии: {{$product->count}} шт.</p>

                @auth()
                    <button type="submit" @click = "addToCart({{$product->id}})" class="btn btn-primary btn-lg mt-3">Купить</button>
                @endauth

                @guest()
                    <a href="{{route('authPage')}}"><button type="submit" class="btn btn-primary btn-lg mt-3">Купить</button></a>
                @endguest
            </div>
        </div>
    </div>

    <script>
        const Product = {
            data(){
                return {
                    message:'',
                    message_danger: '',
                }
            },

            methods:{
                async addToCart(id){
                    const response = await fetch('{{route('addToCart')}}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                            'Content-Type': 'application/json',
                        },
                        body:JSON.stringify({
                            product_id:id,
                        })
                    });

                    if (response.status === 200){
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = null;
                        }, 3000);
                    }

                    if (response.status === 400){
                        this.message_danger = await response.json();
                        setTimeout(() => {
                            this.message_danger = null;
                        }, 3000);
                    }
                }
            }
        }
        Vue.createApp(Product).mount('#productPage');
    </script>
@endsection