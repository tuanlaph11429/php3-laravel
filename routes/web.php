<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Su dung Request $request trong callback cua route

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
// Thu muc view: resources/views/"welcome".blade.php
Route::get('/', function () {
    $students = [
        [
            'name' => 'Tuannda3',
            'age' => 20,
            'class' => 'WE16201',
            'id' => '1',
            'avatar' => "https://iap.poly.edu.vn/user/ph/PH13025.jpg"
        ],
        [
            'name' => 'Tuannda3',
            'age' => 20,
            'class' => 'WE16201',
            'id' => '2',
            'avatar' => "https://iap.poly.edu.vn/user/ph/PH13025.jpg"
        ],
    ];
    // dd($students);
    return view('welcome', ['students' => $students]);
});

// Thu muc view: resources/views/"auth/login".blade.php => auth.login
Route::get('/login', function () {
    // dd('login view');
    $email = 'tuannda3@fe.edu.vn';
    $password = '123456';
    // return view('auth.login')->with('emaill', $email);
    // view(ten view, mang gia tri truyen sang view)
    return view('auth.login', [
        'emaill' => $email,
        'password' => $password
    ]);
});

Route::get('/home', function () {
    return view('home');
});

// Route kem query string va params
// Voi tham so truyen vao url thi function se nhan 1 tham so tuong ung
Route::get('/users/{userId}/{username?}', function (
    Request $request,
    $userId,
    $userName = 'profile'
) {
    dd($userId, $userName, $request->all());
});