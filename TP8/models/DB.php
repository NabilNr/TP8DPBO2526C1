<?php
class DB {
    protected $db_host;
    protected $db_user;
    protected $db_pass;
    protected $db_name;
    protected $db_link;
    protected $result;

    public function __construct($db_host, $db_user, $db_pass, $db_name) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function open() {
        $this->db_link = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->db_link->connect_error) {
            die("Connection failed: " . $this->db_link->connect_error);
        }
    }

    public function execute($query) {
        $this->result = $this->db_link->query($query);
        return $this->result;
    }

    public function executePrepared($query, $types = "", $params = []) {
        $stmt = $this->db_link->prepare($query);
        if (!empty($types) && !empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        $this->result = $res ? $res : true;
        $stmt->close();
        return $this->result;
    }

    public function getResult() {
        $data = [];
        if ($this->result && $this->result !== true) {
            while ($row = $this->result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function close() {
        if ($this->db_link) {
            $this->db_link->close();
        }
    }
}
?>