<?php

class Menu {
	private $_db,
			$_data;

	public function __construct($menu = null) {
		$this->_db = DB::getInstance();
	}

	public function update($fields = array(), $id = null) {
		if(!$id) {
			$id = $this->data()->id;
			$this->_db->update('admin_categories', $id, $fields);
		} else {
			throw new Exception('There was a problem updating.');
		}
	}

	public function create($fields = array()) {
		if (!$this->_db->insert('admin_categories', $fields)) {
			throw new Exception('There was a problem creating an admin category.');
		}
	}

	public function find($menu = null) {
		if ($menu) {
			$field = (is_numeric($menu)) ? 'id' : 'title';
			$data = $this->_db->get('admin_categories', array($field, '=', $menu));
			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function data() {
		return $this->_data;
	}
}