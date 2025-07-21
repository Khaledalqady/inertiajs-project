<?php

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function(){

    Route::get('/', function () {
    return Inertia::render('Home');
});


Route::get('/users', function () {
    return Inertia::render('Users/Index', [
        'users' => User::query()->when(Request::input('search'), function ($query, $search){
            $query->where( ' name' , 'like', "{$search}%");

        })
        ->withQueryString()
        ->paginate(10)
        ->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'can' => [
                'edit' => app(\Illuminate\Contracts\Auth\Access\Gate::class)->forUser(Auth::user())->check('edit', $user)
            ]
        ]),
        'filters' => Request::only(['search']),
        'can' => [
            'createUser' => Auth::user() && app(\Illuminate\Contracts\Auth\Access\Gate::class)->forUser(Auth::user())->check('create', User::class)
        ]
           
        ]);
   
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
})->middleware('can:create,App/Models\User');

Route::post('/users', function (){
    
   $attributes= Request::validate([
        'name'=> 'required',
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);

    User::create($attributes);

    return redirect ('/users');

});


Route::get('/settings', function () {
    return Inertia::render('Settings');
});



});
