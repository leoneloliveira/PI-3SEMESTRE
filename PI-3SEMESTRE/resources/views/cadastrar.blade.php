@extends("layout")
@section("scriptjs")

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
/*$(function(){
        $("#cpf").mask("000.000.000-00")
        $("#cep").mask("00000-000")
    })*/
</script>


@endsection
@section("conteudo")

<style>
body {
    background-color: #f8f9fa;
}

.col-12 {
    max-width: 800px;
    margin: auto;
    margin-top: 50px;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    /*color: #007bff;*/
}

form {
    margin-top: 20px;
}

label {
    font-weight: bold;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
    margin-bottom: 15px;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
    margin-bottom: 15px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: none;
    border-radius: 5px;
    background-color: #28a745;
    color: #ffffff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #218838;
}

.logo-container {
    text-align: center;

}

.logo-container img {
    max-height: 100px;
    margin-bottom: 15px;
}
</style>




<div class="col-12">

    <div class="col-12">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid mb-3 mt-5">
        </div>
        <h2 class="mb-3 mt-5">Cadastrar Cliente</h2>
    </div>


    <form action="{{ route('cadastrar_cliente') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group  mt-4">
                    NOME: <input type="text" name="USUARIO_NOME" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group mt-4">
                    EMAIL: <input type="text" name="USUARIO_EMAIL" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group mt-4">
                    SENHA: <input type="text" name="USUARIO_SENHA" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group  mt-4">
                    CPF: <input type="text" name="USUARIO_CPF" id="cpf" class="form-control">
                </div>
            </div>

            <div class="col- 8">
                <div class="form-group  mt-4">
                    ENDEREÇO:<input type="text" name="ENDERECO_NOME" class="form-control">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group  mt-4">
                    LOGRADOURO: <input type="text" name="ENDERECO_LOGRADOURO" class="form-control">
                </div>
            </div>

            <div class="col-2">
                <div class="form-group  mt-4">
                    NUMERO: <input type="text" name="ENDERECO_NUMERO" class="form-control">
                </div>
            </div>


            <div class="col-3">
                <div class="form-group  mt-4">
                    COMPLEMENTO: <input type="text" name="ENDERECO_COMPLEMENTO" class="form-control">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group  mt-4">
                    CEP: <input type="text" name="ENDERECO_CEP" id="cep" class="form-control">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group  mt-5">
                    CIDADE: <input type="text" name="ENDERECO_CIDADE" class="form-control">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group  mt-5">
                    ESTADO: <input type="text" name="ENDERECO_ESTADO" class="form-control">
                </div>
            </div>
        </div>

        <input type="submit" value="cadastrar" class="btn btn-success btn-sm mt-4">

    </form>
</div>


@endsection