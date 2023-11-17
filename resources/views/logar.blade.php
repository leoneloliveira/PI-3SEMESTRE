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

<div class="col-12">
    <h2>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
    </h2>

    <form action="{{ route('logar') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="USUARIO_EMAIL">LOGIN:</label>
            <input type="text" name="USUARIO_EMAIL" class="form-control" placeholder="DIGITE SEU USUARIO">
        </div>
        <div class="form-group">
            <label for="USUARIO_SENHA">SENHA:</label>
            <input type="password" name="USUARIO_SENHA" class="form-control" placeholder="DIGITE SUA SENHA">
        </div>

        <input type="submit" value="Logar" class="btn btn-lg btn-primary mt-4">
    </form>
</div>

@endsection

