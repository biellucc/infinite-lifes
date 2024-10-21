<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VisitadoController;
use Illuminate\Support\Facades\Route;

//Rotas do Cliente(Cartao, Carrinho, Comentario,Favorito, Feedback, Pedido, Visitado)
//Rotas da Transportadora(Feedback e Pedido)
//Rotas do Vendedor(Livro, Feedback)
//Rotas que todos tem em comum (Feedback)

//Rotas do SiteController
Route::controller(SiteController::class)->group(function(){
    Route::get('/', 'site')->name('site');
    Route::get('/livro-{titulo?}-{id}', 'livro')->name('site.livro');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('cliente')->controller(ComentarioController::class)->group(function(){
    Route::post('/comentario', 'store')->name('comentario.store');
    Route::put('/comentario/atualizar/{id}', 'atualizar')->name('comentario.atualizar');
    Route::delete('/comentario/deletar/{id}', 'deletar')->name('comentario.deletar');
});

//Rotas de CartaoController
Route::middleware('cliente')->controller(CartaoController::class)->group(function(){
    Route::get('/carteira','index')->name('cartao.index');
    Route::get('/cartao/formulario','formulario')->name('cartao.formulario');
    Route::post('/cartao/formulario','store')->name('cartao.store');
    Route::post('/cartao/deletar/{id}','deletar')->name('cartao.deletar');
    Route::put('/cartao/atualizar/{id}','atualizar')->name('cartao.atualizar');
});

//Rotas do CarrinhoController
Route::middleware('cliente')->controller(CarrinhoController::class)->group(function(){
    Route::get('/carrinhos', 'index')->name('carrinho.index')->middleware(['auth', 'is_cliente']);
    Route::get('/carrinho/remover', 'remover')->name('carrinho.remover');
    Route::post('/carrinho/adicionar', 'store')->name('carrinho.adicionar');
});

//Rotas do PedidoController
Route::middleware('is_not:administrador', 'is_not:vendedor')->controller(PedidoController::class)->group(function(){
    Route::get('/pedidos', 'index')->name('pedido.index');
    Route::get('/pedido/formulario', 'create')->name('pedido.formulario')->middleware('cliente');
    Route::post('/pedido/cadastrar', 'store')->name('pedido.cadastrar')->middleware('cliente');
    Route::get('/pedido/{id}', 'show')->name('pedido.pedido');
    Route::put('/pedido/{id}', 'editar')->name('pedido.alterarStatus')->middleware('transportadora');
});

//Rotas do VisitadoController
Route::middleware('cliente')->controller(VisitadoController::class)->group(function(){
    Route::get('/visitados', 'index')->name('visitado.index');
});

//Rotas do FavoritoController
Route::middleware('cliente')->controller(FavoritoController::class)->group(function(){
    Route::get('/favoritos', 'index')->name('favorito.index');
    Route::get('/favorito/remover', 'remover')->name('favorito.remover');
    Route::post('/favorito/adicionar', 'store')->name('favorito.adicionar');
});

//Rotas do FeedbackController
Route::middleware('is_not:administrador')->controller(FeedbackController::class)->group(function(){
    Route::get('/feedbacks', 'index')->name('feedback.index');
    Route::post('/feedback/adicionar', 'store')->name('feedback.store');
    Route::delete('/feedback/delete/{id}', 'destroy')->name('feedback.destroy');
});

//Rotas do Vendedor

//Rotas do Livro
Route::middleware('vendedor')->controller(LivroController::class)->group(function(){
    Route::get('/estoque', 'index')->name('estoque.index');
    Route::get('/livro/formulario', 'formulario')->name('livro.formulario');
    Route::post('/livro/formulario', 'store')->name('livro.store');
    Route::get('/livro/{titulo?}-{id}', 'livro')->name('livro.livro');
    Route::get('/livro/formulario-atualizar/{id}', 'formulario_atualizar')->name('livro.formulario_atualizar');
    Route::put('/livro/atualizar/{id}', 'atualizar')->name('livro.atualizar');
    Route::delete('/livro/deletar/{id}', 'deletar')->name('livro.deletar');
});

Route::get('/sair', [AuthenticatedSessionController::class, 'destroy'])
->name('sair')->middleware(['auth']);


require __DIR__.'/auth.php';
