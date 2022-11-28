@extends('layout.app')

@section('title')
    Категории
@endsection

@section('main')
    <style>
        table{
            color: black !important;
        }
    </style>

    <div class="container d-flex flex-column align-items-center" id="addPage">
        <h2 class="mt-5">Создать категорию</h2>

        <div v-if="message" class="row d-flex justify-content-center mt-5">
            <div class="col-12" :class="message ? 'alert alert-success': ''">
                @{{message}}
            </div>
        </div>

        <form style="padding: 40px;" class="col-4" id="form" @submit.prevent='AddCategory'>
            <div class="mb-3">
                <label for="title" class="form-label">Название категории</label>
                <input class="form-control" :class="errors.title ? 'is-invalid' : ''" type="text" id="title" name="title">
                <div :class="errors.title ? 'invalid-feedback' : '' " v-for="error in errors.title">
                    @{{error}}
                </div>
            </div>
            <div class="row justify-content-center"><button type="submit" class="col-5 btn btn-primary mt-3">Создать</button></div>
        </form>

        <div class="d-flex justify-content-center flex-column align-items-center col-12">
            <h2 class="m-5">Категории</h2>
            <div class="categoriesTable col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col" class="col-4 text-center">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category, index) in categories">
                            <th scope="row">@{{index+1}}</th>
                            <td>@{{category.title}}</td>
                            <td class="d-flex justify-content-sm-around">
                                <a :href="`{{route('editCategoryPage')}}/${category.id}`"><button type="button" class="btn btn-success">Редактировать</button></a>
                                <button type="submit" class="btn btn-danger" @click="deleteCategory(category.id)">Удалить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const Add={
            data(){
                return{
                    errors:[],
                    message:'',
                    categories:[],
                }
            },
            methods:{
                async AddCategory(){
                    const form = document.querySelector('#form');
                    const form_data = new FormData(form);
                    const response = await fetch('{{route('addCategory')}}', {
                        method: 'post',
                        headers:{
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        body:form_data,
                    });

                    if(response.status === 400){
                        this.errors = await response.json();
                    }

                    if(response.status === 200){
                        this.message = await response.json();
                    }

                    this.getCategories();

                    document.querySelector('#form .form-control').value = '';
                },

                async getCategories(){
                    const response = await fetch('{{route('getCategories')}}');
                    const data = await response.json();
                    this.categories = data.categories;
                },

                async deleteCategory(id){
                    const response = await fetch('{{route('deleteCategory')}}', {
                        method: 'post',
                        headers:{
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_category:id,
                        })
                    });

                    if (response.status === 200){
                        this.message = await response.json();
                        setTimeout(()=>{
                            this.message = null;
                        }, 3000)
                    }

                    this.getCategories();

                }
            },
            mounted(){
                this.getCategories();
            }
        }
        Vue.createApp(Add).mount('#addPage');
    </script>

@endsection
