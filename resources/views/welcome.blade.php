@extends('layout.app')

@section('title')
    Главная
@endsection

@section('main')

    <style>
        .carousel-control-prev-icon, .carousel-control-next-icon {
            filter: invert(1) grayscale(100);
        }

        .carousel-caption h5, .carousel-caption p{
            text-shadow: -0.1em -0.1em 0.1em black, -0.15em -0.15em 0.1em black;
            /* font-size: 1.5rem;
            font-weight: 900;
            -webkit-text-stroke:2px #212529; */
            
        }
    </style>

    <div class="container" id="welcomePage">
        {{-- <h1 class="text-center mt-5">Главная</h1> --}}
        <h5 class="text-center m-5 h2">Новое на сайте!</h5>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item" style="background-size: cover; height: 70vh" v-for='(product, index) in products_slider' :class="index==0 ? 'active' : ''">
                    <img :src="product.img" class="d-block h-100 img-fluid" style="object-fit: cover; margin: 0 auto;" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>@{{product.title}}</h5>
                        <p style="font-size: 1.3rem">@{{product.price}} руб.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="about col-8" style="margin: 3rem auto 0 auto">
            <h2 class="text-center">О нас</h2>
            <p class="fs-3"><b>ComixCom</b> - это большой выбор различных комиксов, по доступным ценам. Мы собрали у себя самую большую коллекцию комиксов на любой вкус, наша компания готова предоставить вам как издания известных издателей, так и начинающих авторов, у нас вы найдёте как выпуски из прошлого, так и самые свежие. И конечно же, мы доставим ваши любимые комиксы прямо к вашей двери!</p>
        </div>
    </div>

    <script>
        const Welcome = {
            data(){
                return{
                    products_slider: [],
                }
            },

            methods:{
                async getProducts(){
                    const response = await fetch('{{route('getProducts')}}');
                    const data = await response.json();
                    this.products_slider = data.products_slider;
                },
            },

            mounted(){
                this.getProducts();
            }
        }
        Vue.createApp(Welcome).mount('#welcomePage');
    </script>
@endsection
