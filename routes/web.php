<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses'=> 'AuthController@register']);
    $router->post('/login', ['uses'=> 'AuthController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses'=> 'MahasiswaController@getAllMahasiswa']);
    $router->get('/profile', ['middleware'=> 'jwt_auth','uses'=> 'MahasiswaController@getAllMahasiswaByToken']);
    $router->get('/{nim}', ['uses'=> 'MahasiswaController@getMahasiswaById']);
    $router->post('/{nim}/matakuliah/{id}', ['uses'=> 'MahasiswaController@addMataKuliahtoMhs']);
    $router->put('/{nim}/matakuliah/{id}', ['uses'=> 'MahasiswaController@deleteMataKuliah']);
    $router->delete('/{nim}', ['uses'=> 'MahasiswaController@deleteMahasiswa']);
});
$router->get('/matakuliah', ['uses'=> 'MataKuliahController@getMataKuliah']);