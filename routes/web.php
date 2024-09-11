<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ResponseContreoller;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SessionController;

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

Route::post("/file/upload", [FileController::class, 'upload'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::prefix('/response')->group(function (){
    Route::get("/hello", [ResponseContreoller::class, 'response']);
    Route::get("/header", [ResponseContreoller::class, 'header']);
    Route::get("/view", [ResponseContreoller::class, 'responseView']);
    Route::get("/json", [ResponseContreoller::class, 'responseJson']);
    Route::get("/file", [ResponseContreoller::class, 'responseFile']);
    Route::get("/download", [ResponseContreoller::class, 'responseDownload']);
});

Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);

Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])->name('redirect-hello');
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

Route::middleware(['contoh:Yuta,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
});

Route::get('/middleware/group', function () {
    return "Group";
})->middleware(['yuta']);

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function () {
    return url()->current();
});

Route::get('/url/named', function () {
    return route('redirect-hello', ['name' => 'Yuta']);
});

Route::get('/url/action', function () {
    return action([FormController::class, 'form']);
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception("Error Sample");
});

Route::get('/error/manual', function () {
    report(new Exception("Error Manual"));
    return "Ok
    ";
});

Route::get('/error/validation', function () {
    throw new App\Exceptions\ValidationException("Error Validation");
});

Route::get('/abort/400', function () {
    abort(400, "Ups Validation Error");
});

Route::get('/abort/401', function () {
    abort(401);
});

Route::get('/abort/500', function () {
    abort(500);
});
