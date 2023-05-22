<?php

class ModelStore extends Model 
{
	public function addStore($data) 
	{
		$statement = $this->db->prepare("INSERT INTO `stores` (name, code_name, mobile, email, country, vat_reg_no, zip_code, cashier_id, address, logo, favicon, sound_effect, status, sort_order, receipt_printer, remote_printing, auto_print, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->execute(array($data['name'], $data['code_name'], $data['mobile'], $data['email'], $data['country'], $data['vat_reg_no'], $data['zip_code'], $data['cashier_id'], $data['address'], $data['logo'], $data['favicon'], $data['sound_effect'], $data['status'], $data['sort_order'], $data['receipt_printer'], $data['remote_printing'], $data['auto_print'], date_time()));

		return $this->db->lastInsertId();    
	}

	public function editStore($store_id, $data) 
	{
			$resolution = $this->getResolution($store_id);

    	$statement = $this->db->prepare("UPDATE `stores` SET `document` = ?, `name` = ?, `code_name` = ?, `mobile` = ?, `email` = ?, `country` = ?, `vat_reg_no` = ?,  `zip_code` = ?, `cashier_id` = ?, `address` = ?, `sound_effect` = ?, `status` = ?, `sort_order` = ?, `receipt_printer` = ?, `remote_printing` = ?, `auto_print` = ?, `deposit_account_id` = ? WHERE `store_id` = ? ");
    	$statement->execute(array($data['document'],$data['name'], $data['code_name'], $data['mobile'], $data['email'], $data['country'], $data['vat_reg_no'], $data['zip_code'], $data['cashier_id'], $data['address'], $data['sound_effect'], $data['status'], $data['sort_order'], $data['receipt_printer'], $data['remote_printing'], $data['auto_print'], $data['deposit_account_id'], $store_id));

    	// $statement = $this->db->prepare("UPDATE `customers` SET `customer_address` = ?,`customer_city` = ?, `customer_state` = ?, `customer_country` = ?");
    	// $statement->execute(array($data['address'], $data['preference']['business_state'], $data['preference']['business_state'], $data['country']));


    	if (!empty($resolution)) {
    		$statement = $this->db->prepare("UPDATE `invoice_resolution` SET `consecutive` = ?,`prefix` = ?, `since` = ?, `until` = ?, `resolution` = ?, `regime` = ?, `date_since` = ?, `ambiente_fac` = ?, `auto_token` = ?, `fac_electronica` = ?, `id_fac_electronica` = ?, `emitir_vender` = ? WHERE `store_id` = ?");
    	}else{
    		$statement = $this->db->prepare("INSERT INTO `invoice_resolution` (consecutive, prefix, since, until, resolution, regime, date_since, ambiente_fac, auto_token, fac_electronica, id_fac_electronica,emitir_vender, store_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    	}

    	$statement->execute(array($data['consecutive'], $data['preference']['sales_reference_prefix'], $data['since'], $data['until'], $data['resolution'], $data['regime'], $data['date_since'], $data['ambiente_fac'], $data['auto_token'], $data['fac_electronica'], $data['id_fac_electronica'], $data['emitir_vender'], $store_id));

    	return $store_id;
	}

	public function editPreference($store_id, $preference = array())
	{
		if (empty($preference)) {
			$preference = array();
		}
		
		// Update timezone in _init.php

		$timezone = $preference['timezone'];
		$index_path = ROOT . '/_init.php';
		@chmod($index_path, 0777);
		if (is_writable($index_path) === false) {
			throw new Exception(trans('timezone_not_change_in_init.php'));
			return false;
		} else {
			// $file = $index_path;
			// $filecontent = "$" . "timezone = '". $timezone ."';";
			// $fileArray = array(3 => $filecontent);
			// replace_lines($file, $fileArray);
			// @chmod($index_path, 0644);
		}
		$statement = $this->db->prepare("UPDATE `stores` SET `preference` = ? WHERE `store_id` = ?");
    	$statement->execute(array(serialize($preference), $store_id));

    	return $store_id;
	}

	public function deleteStore($store_id) 
	{
    	$statement = $this->db->prepare("DELETE FROM `stores` WHERE `store_id` = ? LIMIT 1");
    	$statement->execute(array($store_id));

        return $store_id;
	}

	public function getStore($store_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM `stores` WHERE `store_id` = ?");
	  	$statement->execute(array($store_id));

	  	return $statement->fetch(PDO::FETCH_ASSOC);
	}

		public function getResolution($store_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM `invoice_resolution` WHERE `store_id` = ?");
	  	$statement->execute(array($store_id));

	  	return $statement->fetch(PDO::FETCH_ASSOC);
	}

	public function getStoreIDs($data = array()) 
	{
		$ids = array();
		foreach ($this->getStores($ids) as $store) {
			$ids[] = $store['store_id'];
 		}
 		return $ids;
	}

	public function getStores($data = array()) 
	{
		$sql = "SELECT * FROM `stores`";

		if (isset($data['filter_name'])) {
			$sql .= " AND `name` LIKE '" . $data['filter_name'] . "%'";
		}

		$sql .= " GROUP BY `store_id`";

		$sort_data = array(
			'name'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY `store_id`";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$statement = $this->db->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getStoreIdByCode($code_name)
	{
		$statement = $this->db->prepare("SELECT `store_id` FROM `stores` WHERE `code_name` = ?");
		$statement->execute(array($code_name));
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		return isset($row['store_id']) ? $row['store_id'] : null;
	}

	public function getCity($id)	{
		$statement = $this->db->prepare("SELECT * FROM `city` where `id_department` = ?");
		$statement->execute(array($id));
	 return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getdepartment()	{
		$statement = $this->db->prepare("SELECT * FROM `department`");
		$statement->execute(array());
	 return $statement->fetchAll(PDO::FETCH_ASSOC);
	}


	public function total() 
	{
		$statement = $this->db->prepare("SELECT * FROM `stores` WHERE `status` = ?");
		$statement->execute(array(1));

		return $statement->rowCount();
	}

	public function getCashiers($store_id) 
	{

		
			$and = user_group_id() != 1 ? " AND `users`.`id` != 1 " : '';
		
		$statement = $this->db->prepare("SELECT * FROM `users`
		LEFT JOIN `user_to_store` as u2s ON (`users`.`id` = `u2s`.`user_id`) 
		LEFT JOIN `user_group` as ug ON (`users`.`group_id` = `ug`.`group_id`) 
		 WHERE `store_id` = ? $and ");
	  	//$statement->execute(array($store_id, 'cashier'));
	  		$statement->execute(array($store_id));

	  	return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getSalesmans($store_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM `users`
		LEFT JOIN `user_to_store` as u2s ON (`users`.`id` = `u2s`.`user_id`) 
		LEFT JOIN `user_group` as ug ON (`users`.`group_id` = `ug`.`group_id`) 
		 WHERE `store_id` = ? AND `ug`.`slug` = ?");
	  	$statement->execute(array($store_id, 'salesman'));

	  	return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
}