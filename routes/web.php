<?php

// require_once '../app/Helpers/functions.php';

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\Categories;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\PostController;

use App\Models\Mechanics;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Doctors\Auth\LoginController;

use App\Http\Controllers\Doctors\IndexController;

use App\Http\Controllers\Admin\PostsController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\Posts;
use App\Models\User;
use App\Policies\PostsPolicy;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    echo '<h1>Laravel</h1>';
});

Route::get('/auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/auth/facebook/callback', function () {
    return 'Login callback function laravael';
});

Route::get('/chinh-sach-bao-mat', function () {
    return "<h1>Chinh sach bao mat</h1>";
});


Auth::routes([
    'register' => false,
]);


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name('index')->can('viewAny', Posts::class);

        Route::get('/add', [PostsController::class, 'add'])->name('add')->can('create', Posts::class);

        Route::post('/add', [PostsController::class, 'postAdd'])->can('create', Posts::class);

        Route::get('/edit/{post}', [PostsController::class, 'edit'])->name('edit')->can('posts.edit');

        Route::post('/edit/{post}', [PostsController::class, 'postEdit'])->can('posts.edit');

        Route::get('/delete/{post}', [PostsController::class, 'delete'])->name('delete')->can('posts.delete');
    });

    Route::prefix('groups')->name('groups.')->middleware('can:groups')->group(function () {
        Route::get('/', [GroupsController::class, 'index'])->name('index');

        Route::get('/add', [GroupsController::class, 'add'])->name('add');

        Route::post('/add', [GroupsController::class, 'postAdd'])->name('add');

        Route::get('/edit/{group}', [GroupsController::class, 'edit'])->name('edit');

        Route::post('/edit/{group}', [GroupsController::class, 'postEdit'])->name('postEdit');

        Route::get('/delete/{group}', [GroupsController::class, 'delete'])->name('delete');

        Route::get('/permissions/{groups}', [GroupsController::class, 'permissions'])->name('permissions');

        Route::post('/permissions/{groups}', [GroupsController::class, 'postPermissions']);
    });

    Route::prefix('users')->name('users.')->middleware('can:users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');

        Route::get('/add', [UsersController::class, 'add'])->name('add')->can('create', User::class);

        Route::post('/add', [UsersController::class, 'postAdd'])->name('add')->can('create', User::class);

        Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('edit')->can('users.edit');

        Route::post('/edit/{user}', [UsersController::class, 'postEdit'])->name('postEdit')->can('users.edit');

        Route::get('/delete/{user}', [UsersController::class, 'delete'])->name('delete')->can('users.delete');
    });
});
