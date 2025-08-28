<?php


use App\Models\Post;
use App\Models\User as AppUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    $user = Auth::user();
    if ($user instanceof AppUser) {
        $posts = $user->userCoolPosts()->latest()->get();
    } else {
        $posts = Post::latest()->get();
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [userController::class, 'register']);
Route::post('/logout', [userController::class, 'logout']);
Route::post('/login', [userController::class, 'login']);


//Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost'])->middleware('auth');
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'delete'])->middleware('auth');