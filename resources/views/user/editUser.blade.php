@extends('layout.app')

@section('title')
    Изменить данные
@endsection

@section('main')
    <div class="container" id="editUser">
        <div class="row justify-content-center"><h2 class="text-center m-5 ">Изменить данные</h2></div>
        <div class="row justify-content-center">
            <form class="col-5" id="form" @submit.prevent="editUser">
                <div class="mb-3">
                    <label for="name" class="form-label ">Имя</label>
                    <input value="{{\Illuminate\Support\Facades\Auth::user()->name}}" type="text" class="form-control" id="name" name="name" :class="errors.name ? 'is-invalid' : '' ">
                    <div :class="errors.name ? 'invalid-feedback' : '' " v-for="error in errors.name">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label ">Фамилия</label>
                    <input value="{{\Illuminate\Support\Facades\Auth::user()->surname}}" type="text" class="form-control" id="surname" name="surname" :class="errors.surname ? 'is-invalid' : '' ">
                    <div :class="errors.surname ? 'invalid-feedback' : '' " v-for="error in errors.surname">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="patronymic" class="form-label ">Отчество</label>
                    <input value="{{\Illuminate\Support\Facades\Auth::user()->patronymic}}" type="text" class="form-control" id="patronymic" name="patronymic" :class="errors.patronymic ? 'is-invalid' : '' ">
                    <div :class="errors.patronymic ? 'invalid-feedback' : '' " v-for="error in errors.patronymic">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label ">Логин</label>
                    <input value="{{\Illuminate\Support\Facades\Auth::user()->login}}" type="text" class="form-control" id="login" name="login" :class="errors.login ? 'is-invalid' : '' ">
                    <div :class="errors.login ? 'invalid-feedback' : '' " v-for="error in errors.login">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label ">Email</label>
                    <input value="{{\Illuminate\Support\Facades\Auth::user()->email}}" type="email" class="form-control" id="email" name="email" :class="errors.email ? 'is-invalid' : '' ">
                    <div :class="errors.email ? 'invalid-feedback' : '' " v-for="error in errors.email">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label ">Новый пароль</label>
                    <input type="password" class="form-control" name="newPassword" id="newPassword" :class="errors.newPassword ? 'is-invalid' : '' ">
                    <div :class="errors.newPassword ? 'invalid-feedback' : '' " v-for="error in errors.newPassword">
                        @{{error}}
                    </div>
                </div>
                <button data-bs-toggle="modal" data-bs-target="#editUserModal" type="button" class="btn btn-primary col-5" style="margin-left: 50%; transform: translateX(-50%)">Сохранить</button>
                <!-- Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Введите действующий пароль</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent = 'makeAnOrder' id="orderForm" class="col-12" method="POST">
                                    <div class="col-12 d-flex flex-wrap justify-content-center mb-3">
                                        <input type="password" style="width: 66.6666%" class="form-control" :class="errors.password ? 'is-invalid' : '' " placeholder="Введите пароль" name="password" id="password">
                                        <div style="width: 66.6666%" :class="errors.password ? 'invalid-feedback' : '' " v-for="error in errors.password">
                                            @{{error}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary col-3" style="height: 40px">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const EditUser ={
            data(){
                return{
                    errors:[],
                }
            },
            methods:{
                async editUser(){
                    const form = document.querySelector('#form');
                    const form_data = new FormData(form);
                    const response = await fetch('{{route('editUserSave')}}',{
                        method:'post',
                        headers:{
                            'X-CSRF-TOKEN':'{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if (response.status===400){
                        this.errors = await response.json();
                        if(this.errors && !this.errors.password){
                            $('#editUserModal').modal('hide');
                            document.querySelector('#password').value = '';
                        }
                    }
                    if (response.status===200){
                        window.location = response.url
                    }
                },

            }
        }
        Vue.createApp(EditUser).mount('#editUser');
    </script>
@endsection

