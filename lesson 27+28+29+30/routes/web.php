<?php
Route::group(['middleware' => 'Maintenance'], function () {

		Route::get('/', function () {
				return view('style.home');
			});
	});

Route::get('maintenance', function () {

		if (setting()->status == 'open') {
			return redirect('/');
		}

		return view('style.maintenance');
	});