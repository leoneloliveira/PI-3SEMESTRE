@extends("layout")
@section("conteudo")

<style>
body {
    background-color: #f8f9fa;
}

.col-12 {
    max-width: 400px;
    margin: auto;
    margin-top: 50px;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #007bff;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #ffffff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    height: auto;
}
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
                    </h2>

                    <form action="{{ route('logar') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="USUARIO_EMAIL" class="form-label">LOGIN:</label>
                            <input type="text" name="USUARIO_EMAIL" class="form-control" placeholder="Digite seu usuário">
                        </div>
                        <div class="mb-3">
                            <label for="USUARIO_SENHA" class="form-label">SENHA:</label>
                            <input type="password" name="USUARIO_SENHA" class="form-control" placeholder="Digite sua senha">
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg btn-block"  style="background-color: #e44d26;">Entrar</button>
                    </form>
                    
                    <hr class="my-4">

                    <p class="text-center">
                        <small>Não tem uma conta? <a href="{{ route('cadastrar') }}">Cadastre-se</a></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection