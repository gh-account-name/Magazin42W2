@extends('layout.app')

@section('title')
    Администрирование заказов
@endsection

@section('main')

    <style>
        /* tbody>tr>td{
            border-bottom-width: 0 !important;
        }
        tbody>tr{
            border-bottom: 1px #dee2e6 solid;
        } */
        .tabl>div{
            padding: 0.5rem
        }
        .tbody{
            border-bottom: 1px #dee2e6 solid;
        }
        .buttons button {
            font-size: 0.7rem;
            padding: 0.3rem 0.5rem;
        }
        /* .pmform{
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        } */
    </style>

    <div class="container pt-5" id="ordersPage">

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

        <div class="d-flex justify-content-center flex-column align-items-center col-12">
            <h2>Заказы</h2>

            <div class="sort-fiter d-flex justify-content-between flex-wrap col-10 mb-5" style="margin: 0 auto">
                <div class=" col-2 mt-4">
                    <label class="form-label">По имени</label>
                    <input v-model='searchValue' type="text" class="form-control" placeholder="Начните вводить">
                </div>
                <div class=" col-3 mt-4">
                    <label class="form-label" for="attribute-select">Сортировать по:</label>
                    <select v-model='sortOption' class="form-select" name="attribute-select" id="attribute-select">
                        <option value="">Нет</option>
                        <option value="created_at">По новизне</option>
                        <option value="summ">По сумме заказа</option>
                        <option value="status">По статусу</option>
                    </select>
                </div>
                <div class=" col-3 mt-4">
                    <label class="form-label" for="category-select">По статусу:</label>
                    <select v-model='filterOption' class="form-select" name="category-select" id="category-select">
                        <option value="">Все</option>
                        <option value="в обработке">В обработке</option>
                        <option value="отклонён">Отклонён</option>
                        <option value="подтверждён">Подтверждён</option>
                    </select>
                </div>
                <div class=" col-2 mt-4 d-flex align-items-center justify-content-between">
                    <label class="form-label m-0" for="reverseCheck">В обратном порядке</label>
                    <input type="checkbox" id="reverseCheck" name="reverseCheck" v-model='reverseCheck'>
                </div>
            </div>

            <div class="cartTable col-10">
                <div class="tabl">
                    <div class="thead row" style="font-weight: bold; border-bottom: 3px #212529 solid">
                        <div class="col-1 text-center">#</div>
                        <div class="col-4">ФИО заказчика</div>
                        <div class="col-2">Сумма заказа</div>
                        <div class="col-2">Статус</div>
                        <div class="col-3">Действие</div>
                    </div>

                        <div class="tbody row" v-for="(order, index) in searchName">
                            <div class="col-1 d-flex align-items-center justify-content-center" style="font-weight: bold">@{{index + 1}}</div>
                            <div class="col-4 d-flex align-items-center" style="font-weight: bold">@{{order.user.name}} @{{order.user.surname}} @{{order.user.patronymic}}</div>
                            <div class="col-2 d-flex align-items-center" style="font-weight: bold;">@{{order.summ}} руб.</div>
                            <div class="col-2 d-flex align-items-center"
                                 :class="order.status == 'подтверждён' ? 'text-success' :
                                 order.status == 'в обработке' ? 'text-warning' :
                                 'text-danger'"
                                 style="font-weight: bold">
                                @{{order.status}}</div>
                            <div class="col-3 d-flex align-items-center buttons justify-content-between">
                                <button @click="confirmOrder(order.id)"  v-if="order.status == 'в обработке'" class="btn btn-success">Подтвердить</button>

                                <button v-if="order.status == 'в обработке'" data-bs-toggle="modal" :data-bs-target="`#rejectOrderComment_${order.id}`" class="btn btn-danger">Отменить</button>

                                <button type="submit" class="btn  btn-dark" data-bs-toggle="modal" :data-bs-target="`#orderDetails_${order.id}`">Подробнее</button>
                            </div>
                            <div class="modals">
                                <!-- Модальное окно для просмотра заказа -->
                                <div class="modal fade" :id="`orderDetails_${order.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Подробности заказа №@{{ order.id }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="tabl">
                                                        <div class="thead row" style="font-weight: bold; border-bottom: 3px #212529 solid">
                                                            <div class="col-1 text-center">#</div>
                                                            <div class="col-5">Товар</div>
                                                            <div class="col-3">Стоимость</div>
                                                            <div class="col-3">Количество</div>
                                                        </div>

                                                        <div class="tbody row" v-for="(cart, index) in order.carts">
                                                            <div class="col-1 d-flex align-items-center justify-content-center" style="font-weight: bold">@{{index+1}}</div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <img :src="cart.product.img" alt="product" style="width:15%; margin-right: 5%">
                                                                <a href=""><p style="font-weight: bold; margin:0;">@{{cart.product.title}}</p></a>
                                                            </div>
                                                            <div class="col-3 d-flex align-items-center" style="font-weight: bold">@{{cart.summ}} руб.</div>
                                                            <div class="col-3 d-flex align-items-center" style="font-weight: bold">
                                                                <p class="m-0 p-2">@{{cart.count}}</p>
                                                            </div>
                                                        </div>
                                                        <p class="fw-bold mt-3">Итого: @{{ order.summ }} руб.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Модальное окно для комментария при отклонении заказа -->
                                <div class="modal fade" :id="`rejectOrderComment_${order.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Отклонение заказа №@{{ order.id }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form @submit.prevent = "rejectOrder(order.id)" :id="`rejectOrderForm_${order.id}`">
                                                        <label class="form-label" for="comment">Комментарий</label>
                                                        <textarea required class="form-control" name="comment" id="comment" placeholder="Объясните причину отклонения заказа"></textarea>
                                                        <div class="modal-footer border-0">
                                                            <button type="submit" class="btn btn-danger">Отклонить</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="mt-5" v-if="orders.length == 0">
                            <p class="h4 text-center">Заказов нет</p>
                        </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        const Orders = {
            data(){
                return {
                    message:'',
                    message_danger: '',
                    orders: [],
                    sortOption: '',
                    filterOption: '',
                    searchValue: '',
                    reverseCheck: false,
                }
            },

            methods:{
                async getOrders(){
                    const response = await fetch('{{route('getOrders')}}');
                    const data = await response.json();
                    this.orders = data.orders_admin;
                },

                async confirmOrder(id){
                    const response = await fetch('{{route('confirmOrder')}}',{
                        method:'post',
                        headers:{
                            'X-CSRF-TOKEN':'{{csrf_token()}}',
                            'Content-Type': 'application/json',
                        },
                        body:JSON.stringify({
                            id:id,
                        })
                    });

                    if (response.status === 200){
                        this.message = await response.json();
                        setTimeout(()=>{
                            this.message = null;
                        }, 3000);
                    }

                    if (response.status === 400){
                        this.message_danger = await response.json();
                        setTimeout(()=>{
                            this.message_danger = null;
                        }, 3000);
                    }

                    this.getOrders();

                },

                async rejectOrder(id){
                    const form = document.querySelector(`#rejectOrderForm_${id}`);
                    const form_data = new FormData(form);
                    form_data.append('order_id', id);
                    const response = await fetch('{{route('rejectOrder')}}',{
                        method: 'post',
                        headers:{
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        body: form_data,
                    });

                    if(response.status === 200){
                        window.location = response.url;
                    }
                }, 
            },

            mounted(){
                this.getOrders();
            },

            computed:{
                sortOrders(){      
                    if(this.sortOption === 'summ'){
                        return [...this.orders].sort((order1,order2)=>order1[this.sortOption] - order2[this.sortOption]);
                    }                                                                        //↓ это не тернарный оператор, это что-то типо подстраховки вроде
                    let result = [...this.orders].sort((order1,order2)=>order1[this.sortOption]?.localeCompare(order2[this.sortOption]));
                    if (this.sortOption === 'created_at'){ //чтобы было от новых к старым
                        return result.reverse();
                    }
                    return result
                },

                filterOrders(){
                    if(this.filterOption){
                        return [...this.sortOrders].filter(order => order.status == this.filterOption);
                    }
                    return [...this.sortOrders]
                },

                searchName(){
                    if(this.searchValue){
                        return [...this.filterOrders].filter(order => `${order.user.name} ${order.user.surname} ${order.user.patronymic}`.includes(this.searchValue));
                    }
                    if(this.reverseCheck){
                        return [...this.filterOrders].reverse()
                    } else{
                        return [...this.filterOrders]
                    }
                    
                }
            },
        }

        Vue.createApp(Orders).mount('#ordersPage');
    </script>
@endsection
