<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;

class Settings extends Controller {

	public function setting() {
		return view('admin.settings', ['title' => trans('admin.settings')]);
	}

	public function setting_save() {
		$data = $this->validate(request(), [
				'logo' => v_image(),
				'icon' => v_image()], [],
			[
				'logo' => trans('admin.logo'),
				'icon' => trans('admin.icon')
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'settings',
					'upload_type' => 'single',
					'delete_file' => setting()->logo,
				]);
		}

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'settings',
					'upload_type' => 'single',
					'delete_file' => setting()->icon,
				]);
		}
		Setting::orderBy('id', 'desc')->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('settings'));
	}
}
