<?php
class Department extends DB {
    public function getDepartments() {
        $query = "SELECT * FROM departments ORDER BY id ASC";
        return $this->execute($query);
    }

    public function getDepartmentById($id) {
        $query = "SELECT * FROM departments WHERE id = ?";
        return $this->executePrepared($query, "i", [$id]);
    }

    public function addDepartment($data) {
        $query = "INSERT INTO departments (dept_name, faculty) VALUES (?, ?)";
        return $this->executePrepared($query, "ss", [$data['dept_name'], $data['faculty']]);
    }

    public function updateDepartment($id, $data) {
        $query = "UPDATE departments SET dept_name = ?, faculty = ? WHERE id = ?";
        return $this->executePrepared($query, "ssi", [$data['dept_name'], $data['faculty'], $id]);
    }

    public function deleteDepartment($id) {
        $query = "DELETE FROM departments WHERE id = ?";
        return $this->executePrepared($query, "i", [$id]);
    }
}
?>