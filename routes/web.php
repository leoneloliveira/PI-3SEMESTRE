<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;

Route::get('/', [ProdutoController::class, 'index'])->name('home');

// Routes for the category
Route::get('/categoria', [ProdutoController::class, 'categoria'])->name('categoria');
Route::get('/{idcategoria}/categoria', [ProdutoController::class, 'categoria'])->name('categoria_por_id');

// Routes for customer (cliente)
Route::post('/cliente/cadastrar', [ClienteController::class, 'cadastrarCliente'])->name('cadastrar_cliente');
Route::get('/cadastrar', [ClienteController::class, 'cadastrar'])->name('cadastrar');

// Routes for user (usuario)
Route::post('/logar', [UsuarioController::class, 'logar'])->name('logar');
Route::get('/logar', [UsuarioController::class, 'showLoginForm'])->name('logar_page');
Route::get('/sair', [UsuarioController::class, 'sair'])->name('sair');

// Routes for the shopping cart (carrinho)
Route::get('/{idproduto}/carrinho/adicionar', [ProdutoController::class, 'adicionarCarrinho'])->name('adicionar_carrinho');
Route::get('/carrinho', [ProdutoController::class, 'verCarrinho'])->name('ver_carrinho');
Route::get('/{indice}/carrinho', [ProdutoController::class, 'excluirCarrinho'])->name('carrinho_excluir');
Route::post('/carrinho/finalizar', [ProdutoController::class, 'finalizar'])->name('carrinho_finalizar');
Route::get('/compras/historico', [ProdutoController::class, 'historico'])->name('compra_historico');
Route::post('/atualizar-quantidade', [ProdutoController::class,'atualizarQuantidade'])->name('carrinho.atualizar_quantidade');
Route::post('/compras/detalhes', [ProdutoController::class,'detalhes'])->name('compra_detalhes');

Route::get('/resultados',[ProdutoController::class, 'mostrarResultados'])->name('resultados');

Route::get('/produto/{id}', [ProdutoController::class, 'mostrarDetalhes'])->name('detalhes_produto');
