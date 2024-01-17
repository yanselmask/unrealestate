<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');

        //Pages
        Route::get('/pages/{page}', 'showPage')->name('pages.show');

        //Currency
        Route::get('/currency/{currency}', 'changeCurrency')->name('currency.change');

        //Listing
        Route::get('/agent/{agent}/', 'agentListing')->name('agent.listing');
        Route::get('/agent/{agent}/reviews', 'agentReviewsListing')->name('agent.listing.reviews');
        Route::post('/review/like/{review}', 'likeReview')->name('review.like');
        Route::post('/properties/like/{property}', 'likeProperty')->name('properties.like');
        Route::get('/listing/create', 'addListing')->name('home.listing.add');
        Route::get('/listing/{property}/edit', 'editListing')->name('home.listing.edit');
        Route::post('/listing/create', 'storeListing')->name('home.listing.store');
        Route::patch('/listing/{property}', 'updateListing')->name('home.listing.update');
        Route::post('/listing/message', 'sendMessage')->name('listing.message');
        Route::get('/search', 'searchListing')->name('home.listing.search');
        Route::post('/listing/upload_file', 'uploadFile')->name('home.listing.uploadfile');
        Route::delete('/listing/remove_file', 'removeFile')->name('home.listing.removefile');
        Route::post('/listing/review/{property}', 'storeReview')->name('listing.review.store');
        Route::get('/listing/{property}', 'showListing')->name('home.listing.show');
    });

Route::get('pages/{page}/editor', [PageController::class, 'editor'])
    ->name('pages.editor');

Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')
        ->name('blog.index');
    Route::get('/blog/{post}', 'show')
        ->name('blog.show');
    Route::post('/blog/comment/{post}/{parent?}', 'comment')
        ->name('blog.comment');
    Route::delete('/blog/comment/{comment}', 'deleteComment')
        ->name('blog.comment.delete');
    Route::patch('/blog/comment/{comment}', 'editComment')
        ->name('blog.comment.edit');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('account')->group(function () {
        Route::get('/change-password', [ProfileController::class, 'changePassword'])
            ->name('profile.password');
        Route::get('/request-password', [ProfileController::class, 'requestNewPassword'])
            ->name('profile.newpassword');
        Route::get('/reviews', [ProfileController::class, 'reviews'])
            ->name('profile.reviews');
        //Listing
        Route::get('/listing', [ProfileController::class, 'listing'])
            ->name('profile.listing');
        Route::patch('/profile/listing/status/{listing}', [ProfileController::class, 'changeStatusListing'])
            ->name('profile.listing.change.status');
        Route::delete('/profile/listing/all', [ProfileController::class, 'destroyAllListing'])
            ->name('profile.listing.destroy.all');
        Route::delete('/profile/listing/{listing}', [ProfileController::class, 'destroyListing'])
            ->name('profile.listing.destroy');
        //Wishlist
        Route::get('/wishlist', [ProfileController::class, 'wishlist'])
            ->name('profile.wishlist');
        Route::delete('/profile/wishlist/all', [ProfileController::class, 'clearWishlist'])
            ->name('profile.wishlist.destroy.all');
        //Notifications
        Route::get('/notifications', [ProfileController::class, 'notifications'])
            ->name('profile.notifications');
        Route::patch('/notifications', [ProfileController::class, 'updateNotifications'])
            ->name('profile.notifications.update');
    });
});

require __DIR__ . '/auth.php';
