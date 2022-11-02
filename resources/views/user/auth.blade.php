@extends('layout.app')

@section('title')
    Авторизация
@endsection

@section('main')
    <div class="container" id="authApp">
        <div class="row justify-content-center"><h2 class="text-center m-5">Авторизация</h2></div>

        <div class="row justify-content-center">
            <form class="col-5" id="form" @submit.prevent="Auth">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="login" name="login" :class="errors.login ? 'is-invalid' : '' ">
                    <div :class="errors.login ? 'invalid-feedback' : '' " v-for="error in errors.login">
                        @{{error}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" :class="errors.password ? 'is-invalid' : '' ">
                    <div :class="errors.password ? 'invalid-feedback' : '' " v-for="error in errors.password">
                        @{{error}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-5 mt-5" style="margin-left: 50%; transform: translateX(-50%)">Войти</button>
            </form>
        </div>
    </div>
    <script>
        const Authorisation = {
            data(){
                return {
                    errors: [],
                }
            },
            methods: {
                async Auth(){
                    const form = document.querySelector('#form');
                    const form_data = new FormData(form);
                    const response = await fetch("{{route('auth')}}", {
                        method: 'post',
                        headers:{
                            'X-CSRF-TOKEN':'{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if (response.status === 400){
                        this.errors = await response.json()
                    }
                    if (response.status === 200){
                        window.location = response.url
                    }
                }
            }
        }
        Vue.createApp(Authorisation).mount('#authApp');
    </script>
@endsection
