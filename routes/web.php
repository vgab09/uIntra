<?php

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

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth'], function () {
    //Dashboard
    $this->get('/','Dashboard\DashboardController@dashboard')->name('dashboard');

    //Profile
    $this->get('/profile','Profile\ProfileController@edit')->name('editProfile');
    $this->post('/profile','Profile\ProfileController@update')->name('updateProfile');

    //Designation
    Route::group(['namespace'=>'Designation','prefix' => 'designations'], function () {
        $this->get('/', 'DesignationController@index')->name('indexDesignation');
        $this->get('/new', 'DesignationController@new')->name('newDesignation');
        $this->post('/new', 'DesignationController@insert');
        $this->get('/edit/{id_designation}', 'DesignationController@edit')->name('editDesignation');
        $this->post('/edit/{id_designation}', 'DesignationController@update');
        $this->get('/delete/{id_designation}', 'DesignationController@delete')->name('deleteDesignation');
        $this->post('confirmDelete','designationController@resolveContractAndDelete');
    });

});

