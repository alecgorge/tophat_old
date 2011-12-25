<?php

class ContentManager {
	private $cms;
	private $db;
	private $activeNode;

	public function __construct(TopHat $cms) {
		$this->cms = $cms;
		$this->db = $cms->db();
	}

	/**
	 * @param $id ID of a node or the menupath to the node.
	 * @return array
	 */
	public function getRow($id) {
		if(is_int($id)) {
			$rows = $this->db->query("SELECT * FROM %s WHERE node_id = %d", TH_TABLE_NODES, $id);
		}
		else {
			$rows = $this->db->query("SELECT * FROM %s WHERE node_id = (SELECT node_id FROM menu WHERE path = %s LIMIT 1)", TH_TABLE_NODES, $id);
		}

		return $rows->seek(0);
	}

	public function get($id = false) {
		if($id === false) {
			if(empty($this->activeNode)) {
				$path = $this->cms->urlHandler()->path(true);

				$this->activeNode = new Node($this->cms, $path);
			}
			return $this->activeNode;
		}
	}

	public function find(array $params) {
		$where = array();
		foreach($params as $w => $v) {
			if(is_string($v)) $v = array('string', $v);
			elseif(is_int($v)) $v = array('integer', $v);
			elseif(is_float($v)) $v = array('float', $v);

			$where[] = $w . ' = ' . $this->db->escape($v[0], $v[1]);
		}

		$where = implode(' AND ', $where);

		printf("SELECT * FROM %s WHERE %s", TH_TABLE_NODES, $where);
		return $this->db->query("SELECT * FROM %s WHERE %s", TH_TABLE_NODES, $where)->fetchRow();
	}
}