<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid container">
        <a class="navbar-brand text-white" href="{{route('aboutUs')}}">ComixCom</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Каталог</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('authPage')}}">Авторизация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('registrationPage')}}">Регистрация</a>
                </li>
                @endguest
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Админ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('categoriesPage')}}">Категории</a></li>
                                <li><a class="dropdown-item" href="#">Заказы</a></li>
                                <li><a class="dropdown-item" href="#">Товары</a></li>
                            </ul>
                        </li>
                    @endif
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('cabinetPage')}}">Личный кабинет</a>
                </li>
                <li class="nav-item">
                    <a class="text-white nav-link" href="#">Корзина</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Мои заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('logout')}}">Выйти</a>
                </li>
                @endauth
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
