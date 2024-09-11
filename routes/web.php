<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ResponseContreoller;
use App\Http\Controllers\CookieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Yuta', function () {
    return "Hello Yuta";
});

Route::redirect('/Youtube', '/Yuta');

Route::fallback(function () {
    return "404";
});

Route::view('/hello', 'hello', ['name' => 'Yuta']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Yuta']);
});

Route::get("/hello-world", function () {
    return view('hello.world', ['name' => 'Yuta']);
});

Route::get("/products/{id}", function ($id) {
    return "Product ID: $id";
})->name("product.detail");

Route::get("/products/{id}/items/{item}", function ($id, $item) {
    return "Product ID: $id, Item ID: $item";
})->name("product.item.detail");

Route::get("/categories/{id}", function ($id) {
    return "Category ID: $id";
})->where('id', '[0-9]+');

Route::get("/users/{id?}", function ($id = 404) {
    return "User ID: $id";
});

Route::get("/conflict/{name}", function ($name) {
    return "Conflict: $name";
});

Route::get("/conflict/Yuta", function () {
    return "Conflict 2: Yuta Atuy";
});

Route::get("/produk/{id}", function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link : $link";
});

Route::get("/produk-redirect/{id}", function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get("/controller/hello/request", [HelloController::class, 'request']);

Route::get("/controller/hello/{name}", [HelloController::class, 'hello']);

Route::get("/input/hello", [InputController::class, 'hello']);
Route::post("/input/hello", [InputController::class, 'hello']);

Route::post("/input/hello/first", [InputController::class, 'helloFirst']);

Route::post("/input/hello/input", [InputController::class, 'helloInput']);

Route::post("/input/hello/array", [InputController::class, 'arrayInput']);

Route::post("/input/type", [InputController::class, 'inputType']);

Route::post("/input/filter/only", [InputController::class, 'filterOnly']);

Route::post("/input/filter/except", [InputController::class, 'filterExcept']);

Route::post("/input/filter/merge", [InputController::class, 'filterMerge']);

Route::post("/file/upload", [FileController::class, 'upload']);

Route::get("/response/hello", [ResponseContreoller::class, 'response']);

Route::get("/response/header", [ResponseContreoller::class, 'header']);

Route::get("/response/view", [ResponseContreoller::class, 'responseView']);

Route::get("/response/json", [ResponseContreoller::class, 'responseJson']);

Route::get("/response/file", [ResponseContreoller::class, 'responseFile']);

Route::get("/response/download", [ResponseContreoller::class, 'responseDownload']);

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
