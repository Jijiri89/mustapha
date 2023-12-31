<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Home;

Route::get('/',Home::class)->name('home');
Route::get('/terms',\App\Livewire\Term::class)->name('term');
Route::get('/about',\App\Livewire\About::class)->name('about');
Route::get('/contact',\App\Livewire\Contact::class)->name('contact');















/*Route::get('/', function () {
    $blog=Blog::all();
    return view('welcome',compact('blog'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';*/
