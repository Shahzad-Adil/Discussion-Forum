<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\SocialsController;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\ForumsController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\WatchersController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/forum', [
//     ForumsController::class, 'index'
// ])->name('forum');


Route::get('/dashboard', [
    ForumsController::class, 'index'
])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/github/redirect', [
    SocialsController::class, 'auth'
])->name('social.auth');

Route::get('/github/callback', [
    SocialsController::class, 'callback'
])->name('social.callback');

Route::get('/discussions/{slug}', [
    DiscussionsController::class, 'show'
])->name('discussions');

Route::get('/channel/{slug}', [
    ForumsController::class, 'channel'
])->name('channel');

Route::group(['middleware' => 'auth'], function(){

    Route::resource('channels',ChannelsController::class);

    Route::post('/discussions/store', [
        DiscussionsController::class, 'store'
    ])->name('discussions.store');

    Route::get('/discussions/create/new', [
        DiscussionsController::class, 'create'
    ])->name('discussions.create');

    Route::post('/discussions/reply/{id}', [
        DiscussionsController::class, 'reply'
    ])->name('discussions.reply');

    Route::get('/reply/like/{id}', [
        RepliesController::class, 'like'
    ])->name('reply.like');

    Route::get('/reply/unlike/{id}', [
        RepliesController::class, 'unlike'
    ])->name('reply.unlike');

    Route::get('/discussion/watch/{id}', [
        WatchersController::class, 'watch'
    ])->name('discussion.watch');

    Route::get('/discussion/unwatch/{id}', [
        WatchersController::class, 'unwatch'
    ])->name('discussion.unwatch');

    Route::get('/reply/best/answer/{id}', [
        RepliesController::class, 'best_answer'
    ])->name('reply.best.answer');

    Route::get('/discussion/edit/{slug}', [
        DiscussionsController::class, 'edit'
    ])->name('discussion.edit');

    Route::post('/discussion/update/{id}', [
        DiscussionsController::class, 'update'
    ])->name('discussion.update');

    Route::get('/reply/edit/{id}', [
        RepliesController::class, 'edit'
    ])->name('reply.edit');

    Route::post('/reply/update/{id}', [
        RepliesController::class, 'update'
    ])->name('reply.update');
});

