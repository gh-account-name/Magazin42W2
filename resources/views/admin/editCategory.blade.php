@extends('layout.app')

@section('title')
    Редактировать категорию
@endsection

@section('main')
    <div class="container d-flex flex-column align-items-center" id="editPage">
        <h2 class="mt-5">Редактировать категорию</h2>
        <form @submit.prevent = "EditCategory({{$category->id}})" style="padding: 40px;" class="col-4" method="post" id='form'>
            <div class="mb-3">
                {{-- <input class="visually-hidden" type="text" name="id" value="{{$category->id}}"> --}}
                <label for="title" class="form-label">Название категории</label>
                <input class="form-control" :class="errors.title ? 'is-invalid' : ''" type="text" id="title" name="title" value="{{$category->title}}">
                <div :class="errors.title ? 'invalid-feedback' : '' " v-for="error in errors.title">
                    @{{error}}
                </div>
            </div>
            <div class="row justify-content-center"><button type="submit" class="col-5 btn btn-primary mt-3">Редактировать</button></div>
        </form>
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
                async EditCategory(id){
                    const form = document.querySelector('#form');
                    const form_data = new FormData(form);
                    form_data.append('category_id', id);
                    const response = await fetch('{{route('updateCategory')}}', {
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
                        window.location = response.url;
                    }

                },

            },
        }
        Vue.createApp(Add).mount('#editPage');
    </script>
@endsection
