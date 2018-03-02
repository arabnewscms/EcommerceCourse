<?php
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

		Config::set('auth.defines', 'admin');
		Route::get('login', 'AdminAuth@login');
		Route::post('login', 'AdminAuth@dologin');
		Route::get('forgot/password', 'AdminAuth@forgot_password');
		Route::post('forgot/password', 'AdminAuth@forgot_password_post');
		Route::get('reset/password/{token}', 'AdminAuth@reset_password');
		Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');
		Route::group(['middleware' => 'admin:admin'], function () {
				Route::resource('admin', 'AdminController');
				Route::get('/', function () {
						return view('admin.home');
					});

				Route::any('logout', 'AdminAuth@logout');
			});

	});