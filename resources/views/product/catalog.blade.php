@extends('layout.app')

@section('title')
    Каталог
@endsection

@section('main')

    <style>
        .card{
            transition: 0.3s;
        }
        .card:hover{
            transform: scale(1.01);
            transition: 0.3s;
        }
    </style>

    <div class="container" id="Catalog">
        <h2 class="col-12 text-center mt-5">Каталог</h2>

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

        <div class="row">
            <div class="sort-fiter col-2" style="margin: 0 auto">
                <h4>Фильтры</h4>
                <div class="row mt-4">
                    <label class="form-label" for="attribute-select">Сортировать по:</label>
                    <select v-model='sortOption' class="form-select" name="attribute-select" id="attribute-select">
                        <option value="created_at">По новизне</option>
                        <option value="price">По цене</option>
                        <option value="age">По дате издания</option>
                        <option value="title">По названию</option>
                    </select>
                </div>
                <div class="row mt-4">
                    <label class="form-label" for="category-select">По категориям:</label>
                    <select v-model='filterOption' class="form-select" name="category-select" id="category-select">
                        <option value="">Все</option>
                        <option v-for='category in categories' :value="category.id">@{{category.title}}</option>
                    </select>
                </div>
                <div class="row mt-4">
                    <label class="form-label">По цене:</label>
                    <input v-model='minPrice' type="number" class="form-control" placeholder="от">
                    <input v-model='maxPrice' type="number" class="form-control mt-4" placeholder="до">
                </div>
            </div>
            <div class="products col-8 m-auto mt-5">
                <div class="row row-cols-1 row-cols-md-3 g-4">                         <!-- ↓ забираем результат из последней функции которая работает со списком продуктов -->
                    <div class="col d-flex justify-content-center" v-for="product in filterByPrice">
                        <a :href="`{{route('productPage')}}/${product.id}`" class="card" style="box-shadow: 0px 0px 10px black; text-decoration: none;">
                            <img :src="product.img" class="card-img-top" alt="product" style="height: 100%">
                            <div class="card-body" style="position: relative">
                                <p class="card-text text-center m-0" style="font-size: 0.7rem; color:rgba(0, 0, 0, .5);">@{{product.categry.title}}</p>
                                <h5 class="card-title text-center text-black" style="height: 80px">@{{product.title}}</h5>
                                <span class="d-flex justify-content-between">
                                    <p class="card-text text-black">@{{product.price}} руб.</p>
                                    @auth()
                                    <button class="btn btn-warning" @click.prevent="addToCart(product.id)" style="font-size: 0.7rem; height: 1.75rem">В корзину</button>
                                    @endauth
                                    @guest()
                                        <object><a href="{{route('authPage')}}" class="btn btn-warning" style="font-size: 0.7rem; height: 1.75rem">В корзину</a></object>
                                    @endguest
                                </span>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
    </div>

    <script>
        const Catalog={
            data(){
                return {
                    message: '',
                    message_danger: '',
                    categories: [],
                    products:[],
                    sortOption: 'created_at',
                    filterOption:'',
                    minPrice:'',
                    maxPrice:'',
                }
            },

            methods:{
                async getCategories(){
                    const response = await fetch('{{route('getCategories')}}');
                    const data = await response.json();
                    this.categories = data.categories;
                },

                async getProducts(){
                    const response = await fetch('{{route('getProducts')}}');
                    const data = await response.json();
                    this.products = data.products_catalog;
                },

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
            },

            mounted(){
                this.getCategories();
                this.getProducts();
            },

            computed: {
                sortProducts(){                                                                              //↓ это не тернарный оператор, это что-то типо подстраховки вроде
                    let result = [...this.products].sort((product1,product2)=>String(product1[this.sortOption])?.localeCompare(String(product2[this.sortOption])));
                    if (this.sortOption === 'created_at'){ //чтобы было от новых к старым
                        return result.reverse();
                    }
                    return result
                },

                filterProducts(){
                    if(this.filterOption){
                        return [...this.sortProducts].filter(product => product.categry.id == this.filterOption);
                    }
                    return [...this.sortProducts]
                },

                filterByPrice(){
                    if (this.minPrice || this.maxPrice){

                        if(this.minPrice && this.maxPrice==''){
                            return [...this.filterProducts].filter(product => product.price >= this.minPrice);
                        }

                        if(this.minPrice=='' && this.maxPrice){
                            return [...this.filterProducts].filter(product => product.price <= this.maxPrice);
                        }

                        if(this.minPrice && this.maxPrice){
                            return [...this.filterProducts].filter(product => product.price >= this.minPrice && product.price <= this.maxPrice);
                        }
                    }
                    return [...this.filterProducts]
                }
            }
        }

        Vue.createApp(Catalog).mount('#Catalog');
    </script>
@endsection
