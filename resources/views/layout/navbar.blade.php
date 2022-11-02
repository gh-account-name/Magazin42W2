<nav class="navbar navbar-expand-lg bg-light bg-dark">
    <div class="container-fluid container">
        <a class="navbar-brand text-white" href="{{route('aboutUs')}}">ComixCom</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
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
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('logout')}}">Выйти</a>
                </li>
                @endauth
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
