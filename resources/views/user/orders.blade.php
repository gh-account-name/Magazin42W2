@extends('layout.app')

@section('title')
    Мои заказы
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
            /* font-size: 0.7rem; */
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

<div class="container pt-5" id="myOrdersPage">


    <div v-if="message" class="row d-flex justify-content-center mt-5">
        <div class="col-4 text-center" :class="message ? 'alert alert-success': ''">
            @{{message}}
        </div>
    </div>

    <div v-if="message_warning" class="row d-flex justify-content-center mt-5">
        <div class="col-4 text-center" :class="message_warning ? 'alert alert-warning': ''">
            @{{message_warning}}
        </div>
    </div>

    <div class="d-flex justify-content-center flex-column align-items-center col-12">
        <h2>Заказы</h2>

        <div class="cartTable col-10 mt-3">
            <div class="tabl">
                <div class="thead row" style="font-weight: bold; border-bottom: 3px #212529 solid">
                    <div class="col-1 text-center">#</div>
                    <div class="col-2">Номер заказа</div>
                    <div class="col-2">Количество товаров</div>
                    <div class="col-2">Сумма заказа</div>
                    <div class="col-2">Статус</div>
                    <div class="col-3">Действие</div>
                </div>

                    <div class="tbody row" v-for="(order, index) in orders">
                        <div class="col-1 d-flex align-items-center justify-content-center" style="font-weight: bold">@{{index + 1}}</div>
                        <div class="col-2 d-flex align-items-center" style="font-weight: bold">№@{{order.id}}</div>
                        <div class="col-2 d-flex align-items-center" style="font-weight: bold">@{{order.carts_sum_count}}</div>
                        <div class="col-2 d-flex align-items-center" style="font-weight: bold;">@{{order.summ}} руб.</div>
                        <div class="col-2 d-flex align-items-center"
                             :class="order.status == 'подтверждён' ? 'text-success' :
                             order.status == 'в обработке' ? 'text-warning' :
                             'text-danger'"
                             style="font-weight: bold">
                            @{{order.status}}</div>
                        <div class="col-3 d-flex align-items-center buttons justify-content-between">
                            <button type="submit" class="btn  btn-dark" data-bs-toggle="modal" :data-bs-target="`#orderDetails_${order.id}`">Подробнее</button>
                            <button v-if="order.status != 'подтверждён'" data-bs-toggle="modal" :data-bs-target="`#deleteOrder_${order.id}`" class="btn btn-danger">Отменить</button>
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
                                                            <a :href="`{{route('productPage')}}/${cart.product.id}`"><p style="font-weight: bold; margin:0;">@{{cart.product.title}}</p></a>
                                                        </div>
                                                        <div class="col-3 d-flex align-items-center" style="font-weight: bold">@{{cart.summ}} руб.</div>
                                                        <div class="col-3 d-flex align-items-center" style="font-weight: bold">
                                                            <p class="m-0 p-2">@{{cart.count}}</p>
                                                        </div>
                                                    </div>
                                                    <p class="fw-bold mt-3">Итого: @{{ order.summ }} руб.</p>
                                                </div>
                                                <div v-if='order.comment' class="comment text-danger">Причина отклонения заказа: @{{order.comment}}</div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Модальное окно при отмене заказа -->
                            <div class="modal fade" :id="`deleteOrder_${order.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Отмена заказа №@{{ order.id }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center fw-bold fs-3">Вы уверены что хотите отменить заказ №@{{order.id}}?</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" @click="deleteOrder(order.id)">Да</button>
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
        const MyOrders = {
            data(){
                return {
                    message:'',
                    message_warning: '',
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
                    this.orders = data.orders_user;
                },

                async deleteOrder(id){
                    const response = await fetch(`{{route('deleteOrder')}}/${id}`);
                    this.message_warning = await response.json();
                    setTimeout(() => {
                        this.message_warning = null;
                    }, 3000);
                    this.getOrders();
                }
        
            },

            mounted(){
                this.getOrders();
            },

        }

        Vue.createApp(MyOrders).mount('#myOrdersPage');
    </script>
@endsection
