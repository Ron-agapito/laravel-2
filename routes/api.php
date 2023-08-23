<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

use  App\Http\Controllers ;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*

Route::get('products', function () {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Product::all();
});

*/



#https://laravel.ddev.site/api/products?page=1&limit=10
Route::get('products', function (Request $request) {
    $page = $request->query('page', 0);
    $limit = $request->query('limit', 10);
    return Product::skip($page * $limit)->take($limit)->get();
});


#https://laravel.ddev.site/api/products/1
Route::get('products/{id}', function ($id) {
    return Product::find($id);
});



Route::post('products', function (Request $request) {
    //validate request
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'image' => 'required',
    ]);

    return Product::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'image' => $request->input('image'),
    ]);

});

Route::put('products/{id}', function (Request $request, $id) {
    $product = Product::findOrFail($id);

    //validate request
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'image' => 'required',
    ]);


    $product->update(
        [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $request->input('image'),
        ]
    );

    return $article;
});

Route::delete('products/{id}', function ($id) {
    Product::find($id)->delete();

    return 204;
});
