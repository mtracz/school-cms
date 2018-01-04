<?php 

namespace App\Services;

use App\Models\Admin;

class ManageAdminService {

	protected $is_admin_deleted = false;

	public function deleteAdminFromDB($admin_id) {
		$deletedAdmin = Admin::find($admin_id);

		if($deletedAdmin) {
			// LogService::delete("admin: " . $deletedAdmin->login);
			$deletedAdmin->delete();
			$this->is_admin_deleted = true;
		}
	}

	public function isDeleted() {
		return $this->is_admin_deleted;
	}
}