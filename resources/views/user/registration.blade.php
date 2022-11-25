@extends('layout.app')

@section('title')
    Регистрация
@endsection

@section('main')
    <div class="container" id="regApp">
        <div class="row justify-content-center"><h2 class="text-center m-5 ">Регистрация</h2></div>
        <div class="row justify-content-center">
            <form class="col-5" id="form" @submit.prevent="Registration">
                <div class="mb-3">
                    <label for="name" class="form-label ">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" :class="errors.name ? 'is-invalid' : '' ">
                    <div :class="errors.name ? 'invalid-feedback' : '' " v-for="error in errors.name">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label ">Фамилия</label>
                    <input type="text" class="form-control" id="surname" name="surname" :class="errors.surname ? 'is-invalid' : '' ">
                    <div :class="errors.surname ? 'invalid-feedback' : '' " v-for="error in errors.surname">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="patronymic" class="form-label ">Отчество</label>
                    <input type="text" class="form-control" id="patronymic" name="patronymic" :class="errors.patronymic ? 'is-invalid' : '' ">
                    <div :class="errors.patronymic ? 'invalid-feedback' : '' " v-for="error in errors.patronymic">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label ">Логин</label>
                    <input type="text" class="form-control" id="login" name="login" :class="errors.login ? 'is-invalid' : '' ">
                    <div :class="errors.login ? 'invalid-feedback' : '' " v-for="error in errors.login">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label ">Email</label>
                    <input type="email" class="form-control" id="email" name="email" :class="errors.email ? 'is-invalid' : '' ">
                    <div :class="errors.email ? 'invalid-feedback' : '' " v-for="error in errors.email">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label ">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" :class="errors.password ? 'is-invalid' : '' ">
                    <div :class="errors.password ? 'invalid-feedback' : '' " v-for="error in errors.password">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label ">Повторение пароля</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="rules" id="rules" name="rules" :class="errors.rules ? 'is-invalid' : '' ">
                    <label class="form-check-label " for="rules" style="margin-left: 5px; cursor:pointer">Согласие на обработку данных</label>
                    <div :class="errors.rules ? 'invalid-feedback' : '' " v-for="error in errors.rules">
                        @{{error}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-5" style="margin-left: 50%; transform: translateX(-50%)">Регистрация</button>
            </form>
        </div>
    </div>
    <script>
        const Registration ={
            data(){
                return{
                    errors:[],
                }
            },
            methods:{
                async Registration(){
                    const form = document.querySelector('#form');
                    const form_data = new FormData(form);
                    const response = await fetch('{{route('register')}}',{
                       method:'post',
                       headers:{
                           'X-CSRF-TOKEN':'{{csrf_token()}}',
                       },
                       body: form_data,
                    });
                    if (response.status===400){
                        this.errors = await response.json();
                    }
                    if (response.status===200){
                        window.location = response.url
                    }
                }
            }
        }
        Vue.createApp(Registration).mount('#regApp');
    </script>
@endsection

