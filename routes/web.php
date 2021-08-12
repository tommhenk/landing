<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PagesAddController;
use App\Http\Controllers\PagesEditController;

use App\Http\Controllers\Admin\PortfoliosController;
use App\Http\Controllers\Admin\PortfolioAddController;
use App\Http\Controllers\Admin\PortfolioEditController;

use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceAddController;
use App\Http\Controllers\Admin\ServiceEditController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware(['web'])->group( function () {
    Route::match(['get', 'post'], '/', [IndexController::class, 'execute'])->name('home');
    Route::get('/page/{alias}', [PageController::class, 'execute'])->name('page');
} );

Route::middleware(['web', 'auth'])->prefix('admin')->group( function () {

    Route::get('/', function () {
        if(view()->exists('site.admin.index')){
            $data = ['title'=>'Панель администратора'];

            return view('site.admin.index', $data);
        }
        
    })->name('admin');

    Route::prefix('pages')->group( function () {
        Route::get('/', [PagesController::class, 'execute'])->name('pages');
        Route::match(['get', 'post'], '/add', [PagesAddController::class, 'execute'])->name('pagesAdd');
        Route::match(['get', 'post', 'delete'], '/edit/{page}', [PagesEditController::class, 'execute'])->name('pagesEdit');
    } );

    Route::prefix('portfolios')->group( function () {
        Route::get('/', [PortfoliosController::class, 'execute'])->name('portfolio');
        Route::match(['get', 'post'], '/add', [PortfolioAddController::class, 'execute'])->name('portfolioAdd');
        Route::match(['get', 'post', 'delete'], '/edit/{portfolio}', [PortfolioEditController::class, 'execute'])->name('portfolioEdit');
    } );

    Route::prefix('services')->group( function () {
        Route::get('/', [ServiceController::class, 'execute'])->name('service');
        Route::match(['get', 'post'], '/add', [ServiceAddController::class, 'execute'])->name('serviceAdd');
        Route::match(['get', 'post', 'delete'], '/edit/{service}', [ServiceEditController::class, 'execute'])->name('serviceEdit');
    } );
} );






