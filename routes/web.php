<?php
use App\Http\Controllers\UploadController;
use App\Http\Controllers\WordsController;
use App\Http\Controllers\WordTitlesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// !!!!!!!!! 나중에 라우팅 정리좀


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// 임시 메인
Route::get('/test', function () {
    return Inertia::render('Test');
})->middleware('auth');


// ^ 업로드 관련

// 업로드 페이지 렌더링
Route::get('/upload', function() {
    return Inertia::render('Upload');
});

// 단어 파일(csv) 업로드
Route::post('/upload', [UploadController::class, 'upload']);

// 방금 업로드한 단어장 이름 조회
Route::get('/upload-title', [WordTitlesController::class, 'getUploadWordTitles']);

// 단어장 언어 설정
Route::patch('/update-language', [UploadController::class, 'updateLanguage']);


// ^ 단어장 관련

// 단어장 렌더링
Route::get('/word', function () {
    return Inertia::render("Word");
});
// 단어장 목록 조회
Route::get('/titles', [WordTitlesController::class, 'getAllWordTitles']);

// 단어장에 속한 단어들 조회
Route::get('/worddetail/{id}', [WordsController::class, 'getWords']);

// 단어장 삭제
Route::delete('/delete-title/{id}', [WordTitlesController::class, 'deleteWordTitle']);

// 단어 추가
Route::post('/add-word', [WordsController::class, 'addWord']);

// 단어 삭제
Route::delete('/delete-word/{id}', [WordsController::class, 'deleteWord']);


// ^ 단어장 스토어 관련

// 단어장 스토어 렌더링
Route::get('/store', function () {
    return Inertia::render('Store');
});


// ^ 퀴즈 관련

// 퀴즈 페이지 렌더링
Route::get('/quiz', function() {
    return Inertia::render("Quiz");
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
