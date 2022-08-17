<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\References\CategoryController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Recipe\RecipeController;
use App\Http\Controllers\Searches\SearchController;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\User\UserController;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
//контроллеры администрирования
Route::group([
    'as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'can:admin-panel']
], function () {
    Route::get('/', [HomeController::class, 'adminIndex'])->name('index');
    Route::resource('news', NewsController::class);
    Route::resource('recipes', RecipeController::class);
    Route::resource('news', NewsController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('recipes/add-tag', [RecipeController::class, 'storeTag'])->name('recipes.storeTag');
    Route::post('news/add-tag', [NewsController::class, 'storeTag'])->name('news.storeTag');
    Route::resource('users', UserController::class);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/save', [SettingController::class, 'save'])->name('settings.save');
});

//общие контроллеры
Route::get('/', [HomeController::class, 'siteIndex'])->name('home');
Route::post('search', [SearchController::class, 'search'])->name('search');
Route::resource('news', NewsController::class);
Route::resource('recipes', RecipeController::class);
Route::resource('users', UserController::class);

//действия для авторизованных
Route::group(['middleware' => ['auth']], function () {
    //лайки
    Route::get('news/{id}/{estimation}', [NewsController::class, 'estimation'])->name('news.estimation');
    Route::get('recipes/{id}/{estimation}', [RecipeController::class, 'estimation'])->name('recipes.estimation');
    Route::post('news/{id}/add-comment', [NewsController::class, 'storeComment'])->name('news.storeComment');
    Route::post('recipes/{id}/add-comment', [RecipeController::class, 'storeComment'])->name('recipes.storeComment');
});

//о нас
Route::get('about', function () {
    return view('site.about.index')->with([
        'text' => Setting::where('slug', 'about')->first()->settings->text->value,
    ]);
})->name('about');
// 'middleware' => ['auth', ]]
