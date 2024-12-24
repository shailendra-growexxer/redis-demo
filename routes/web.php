<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedisDemoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redis-demo', function () {
    return view('redis_demo');
});

// String operations
Route::get('/set-redis', [RedisDemoController::class, 'setRedis']);
Route::get('/get-redis', [RedisDemoController::class, 'getRedis']);
Route::get('/delete-redis', [RedisDemoController::class, 'deleteRedis']);
Route::get('/set-with-expiration', [RedisDemoController::class, 'setWithExpiration']);
Route::get('/check-if-exists', [RedisDemoController::class, 'checkIfExists']);
Route::get('/increment-value', [RedisDemoController::class, 'incrementValue']);
Route::get('/decrement-value', [RedisDemoController::class, 'decrementValue']);

// List operations
Route::get('/push-to-list', [RedisDemoController::class, 'pushToList']);
Route::get('/get-list', [RedisDemoController::class, 'getList']);
Route::get('/pop-from-list', [RedisDemoController::class, 'popFromList']);
Route::get('/push-to-left-list', [RedisDemoController::class, 'pushToLeftList']);
Route::get('/get-list-length', [RedisDemoController::class, 'getListLength']);
Route::get('/get-list-range', [RedisDemoController::class, 'getListRange']);

// Set operations
Route::get('/add-to-set', [RedisDemoController::class, 'addToSet']);
Route::get('/get-set', [RedisDemoController::class, 'getSet']);
Route::get('/is-member-of-set', [RedisDemoController::class, 'isMemberOfSet']);
Route::get('/remove-from-set', [RedisDemoController::class, 'removeFromSortedSet']);

// Hash operations
Route::get('/add-to-hash', [RedisDemoController::class, 'addToHash']);
Route::get('/get-hash', [RedisDemoController::class, 'getHash']);
Route::get('/set-multiple-hash-fields', [RedisDemoController::class, 'setMultipleHashFields']);
Route::get('/get-multiple-hash-fields', [RedisDemoController::class, 'getMultipleHashFields']);
Route::get('/get-hash-keys', [RedisDemoController::class, 'getHashKeys']);
Route::get('/get-hash-length', [RedisDemoController::class, 'getHashLength']);

// Sorted Set operations
Route::get('/add-to-sorted-set', [RedisDemoController::class, 'addToSortedSet']);
Route::get('/get-sorted-set', [RedisDemoController::class, 'getSortedSet']);
Route::get('/get-sorted-set-rank', [RedisDemoController::class, 'getSortedSetRank']);
Route::get('/remove-from-sorted-set', [RedisDemoController::class, 'removeFromSortedSet']);
Route::get('/get-sorted-set-by-score', [RedisDemoController::class, 'getSortedSetByScore']);
Route::get('/increment-sorted-set-score', [RedisDemoController::class, 'incrementSortedSetScore']);
Route::get('/get-top-sorted-set', [RedisDemoController::class, 'getTopSortedSet']);
Route::get('/remove-by-rank-from-sorted-set', [RedisDemoController::class, 'removeByRankFromSortedSet']);

// Bitmap operations
Route::get('/set-bitmap', [RedisDemoController::class, 'setBitmap']);
Route::get('/get-bitmap-count', [RedisDemoController::class, 'getBitmapCount']);

// Pub/Sub operations
Route::get('/publish-message', [RedisDemoController::class, 'publishMessage']);
Route::get('/subscribe-to-channel', [RedisDemoController::class, 'subscribeToChannel']);

// Transactions
Route::get('/start-transaction', [RedisDemoController::class, 'startTransaction']);

// Pipelining
Route::get('/use-pipelining', [RedisDemoController::class, 'usePipelining']);
Route::get('/mset-redis', [RedisDemoController::class, 'msetRedis']);
Route::get('/mget-redis', [RedisDemoController::class, 'mgetRedis']);

// TTL and Expiry operations
Route::get('/get-ttl', [RedisDemoController::class, 'getTTL']);
Route::get('/reset-ttl', [RedisDemoController::class, 'resetTTL']);
Route::get('/check-if-expired', [RedisDemoController::class, 'checkIfExpired']);

// Key Management
Route::get('/get-keys-by-pattern', [RedisDemoController::class, 'getKeysByPattern']);
Route::get('/clear-all-keys', [RedisDemoController::class, 'clearAllKeys']);

// HyperLogLog operations
Route::get('/hyperloglog', [RedisDemoController::class, 'hyperLogLog']);

// Geospatial operations
Route::get('/geospatial-add', [RedisDemoController::class, 'geospatialAdd']);
Route::get('/geospatial-distance', [RedisDemoController::class, 'geospatialDistance']);
Route::get('/geospatial-radius', [RedisDemoController::class, 'geospatialRadius']);

// Dump/Restore operations
Route::get('/dump-and-restore', [RedisDemoController::class, 'dumpAndRestore']);