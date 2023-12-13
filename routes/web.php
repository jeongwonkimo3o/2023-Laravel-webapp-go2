<?php

use App\Http\Controllers\CSVExportController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\WordsController;
use App\Http\Controllers\WordTitlesController;
use Illuminate\Contracts\Cache\Store;
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

// TODO: 나중에 라우팅 그룹핑 필요


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
Route::post('/setting-lang/{id}', [UploadController::class, 'updateLanguage']);

// ^ 단어장 관련

// 단어장 렌더링
Route::get('/word', function () {
    return Inertia::render("Word");
});
// 단어장 목록 조회
Route::get('/titles', [WordTitlesController::class, 'getAllWordTitles']);

// 단어장 언어별 조회
Route::get('/titles/{lang}', [WordTitlesController::class, 'getWordTitlesByLang']);

// 단어장에 속한 단어들 조회
Route::get('/worddetail/{id}', [WordsController::class, 'getWords']);

// 단어장 삭제
Route::delete('/delete-title/{id}', [WordTitlesController::class, 'deleteWordTitle']);

// 단어 추가
Route::post('/add-word', [WordsController::class, 'addWord']);

// 단어 삭제
Route::delete('/delete-word/{id}', [WordsController::class, 'deleteWord']);

// 단어 csv 파일로 내보내기
Route::get('/export-wordtitle/{wordTitleId}', [CSVExportController::class, 'export']);


// ^ 단어장 스토어 관련

// 단어장 스토어 렌더링
Route::get('/store', function () {
    return Inertia::render('Store');
});

// 스토어에 저장된 단어장 목록 조회
Route::get('/stored-word-titles', [StoreController::class, 'getStoredWordTitles']);


// word_titles 테이블 store 변경
Route::post('/word-titles/{id}/store', [StoreController::class, 'toggleStoreWordTitle']);

// 스토어에 저장된 단어장 다운로드
Route::post('/download-word-title/{wordTitleId}', [StoreController::class, 'downloadWordTitle']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
