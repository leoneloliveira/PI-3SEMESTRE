<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Games</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="css/app.css">
    @yield("scriptjs")

    <style>
    .cards {}

    .product-card {
        width: 250px;
        height: 400px;
    }

    .product-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    #searchForm button {

        margin-left: 0px;
        /* Ajuste o valor conforme necessário */
    }


    #searchInput {
        top: px;
        width: 500px;
        /* Ajuste o valor conforme necessário */
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }


    .navbar-nav {
        justify-content: space-between;
    }


    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    footer {
        margin-top: auto;
        background-color: #000;
        color: #fff;
    }


    .cart-count {
        background-color: #fff;
        /* Set background color */
        color: #000;
        /* Set text color */
        padding: 1px 5px;
        border-radius: 50%;
        /* Make it a circular shape */
        font-weight: bold;

    }

    .navbar-nav li {
        margin-right: 10px;
        /* Ajuste o valor conforme necessário */


    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }



    .text-uppercase {
        text-transform: uppercase;
    }

    .list-unstyled {
        list-style: none;
        padding: 0;
    }

    .list-unstyled a {
        color: #fff;
        text-decoration: none;
    }

    .list-unstyled a:hover {
        text-decoration: underline;
    }

    .form-control {
        width: 100%;
    }

    .btn-light {
        background-color: #fff;
        color: #333;
    }

    /*codigo header*/
    /* Adaptação das cores e estilo para se aproximar do estilo da Netshoes */
    header {
        background-color: #fff;
    }

    .navbar {
        border-bottom: 2px solid #e5e5e5;
    }



    .nav-link:hover {
        color: #e44d26 !important;
    }

    .btn-light {
        background-color: #e44d26;
        color: #fff;
        border: 1px solid #e44d26;
    }

    .btn-light:hover {
        background-color: #fff;
        color: #e44d26;
    }

    .cart-count {
        background-color: #e44d26;
        color: #fff;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }

    .bi-person-circle {
        font-size: 1.25rem;
    }
    </style>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-black bg-gradient ">
            <div class="container  ">

                <div class="collapse navbar-collapse d-flex   justify-content-center " id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item start-30">
                            <a class="navbar-brand" href="#">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid"
                                    style="max-height: 50px;">
                            </a>
                        </li>
                        <li class="nav-item    ">
                            <a class="nav-link {{ Request::is('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Request::is('categoria') ? 'active' : '' }}"
                                href="{{ route('categoria') }}">Categorias</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Request::is('cadastrar') ? 'active' : '' }}"
                                href="{{ route('cadastrar') }}">Cadastrar</a>
                        </li>

                        <li class="nav-item ">

                            <form id="searchForm" class="form-inline  ">
                                <div class="input-group">
                                    <input id="searchInput" class="form-control me-0" type="search"
                                        placeholder="Buscar produtos..." aria-label="Buscar produtos">
                                    <button class="btn btn-light" type="button" onclick="pesquisarProduto()">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                        </li>

                        @if(!\Auth::user())
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('logar_page') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg> Logar
                            </a>
                        </li>
                        @else
                        <li class="nav-item   ml-auto">
                            <a class="nav-link" href="{{ route('compra_historico') }}">Minhas Compras</a>
                        </li>
                        <li class="nav-item  ml-auto">
                            <a class="nav-link" href="{{ route('sair') }}">Logout</a>
                        </li>

                        @endif




                        <li class="nav-item " style=" margin-top: 5px;">
                            <a class="btn btn-sm ml-20 text-white" href="{{ route('ver_carrinho') }}">
                                <i class="fa fa-shopping-cart fa-lg "></i>
                                <span class="cart-count">
                                    @php
                                    $quantidadeTotalNoCarrinho = 0;
                                    if (auth()->check()) {
                                    $carrinhoItens = \App\Models\ItemCarrinho::where('USUARIO_ID',
                                    auth()->user()->USUARIO_ID)
                                    ->get()
                                    ->reject(function ($item) {
                                    return in_array($item->PRODUTO_ID, session('carrinhoItensRemovidos', []));
                                    });

                                    $quantidadeTotalNoCarrinho = $carrinhoItens->sum('ITEM_QTD');
                                    }
                                    @endphp
                                    {{ $quantidadeTotalNoCarrinho }}
                                </span>
                            </a>
                        </li>


                        @if(\Auth::user())
                        <li class="nav-item">
                            <div class="nav-link text-white">
                                <i class="fas fa-user fa-lg "></i> {{\Auth::user()->USUARIO_NOME}}
                                <a href="{{ route('sair') }}"></a>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <div class="container">
        <div class="row">


            @if(\Auth::user())
            <h2 class="mt-4 text-center">SEJA BEM VINDO, A ALPHA GAMES</h2>
            @endif


            @if($message = Session::get('err'))
            <div class="col-12">
                <div class="alert alert-danger">{{ $message }}</div>
            </div>
            @endif

            @if($message = Session::get('ok'))
            <div class="col-12">
                <div class="alert alert-success">{{ $message }}</div>
            </div>
            @endif


            @yield("conteudo")
        </div>
    </div>

    <footer class="bg-dark text-white ">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="text-uppercase">Atendimento ao Cliente</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Central de Ajuda</a></li>
                        <li><a href="#" class="text-light">Trocas e Devoluções</a></li>
                        <li><a href="#" class="text-light">Fale Conosco</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="text-uppercase">Sobre Nós</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Quem Somos</a></li>
                        <li><a href="#" class="text-light">Trabalhe Conosco</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="text-uppercase">Redes Sociais</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Facebook</a></li>
                        <li><a href="#" class="text-light">Instagram</a></li>
                        <li><a href="#" class="text-light">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="text-uppercase">Receba Ofertas</h5>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Digite seu e-mail">
                        </div>
                        <button type="submit" class="btn btn-light mt-2">Assinar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center py-3">
            &copy; 2023 Alpha Games - Todos os direitos reservados
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function pesquisarProduto() {
        var searchTerm = document.getElementById("searchInput").value;
        window.location.href = "{{ route('resultados') }}?search=" + searchTerm;
    }
    </script>
</body>

</html>