<?php
class Lecturer extends DB {
    public function getLecturers() {
        $query = "SELECT lecturers.*, departments.dept_name 
                  FROM lecturers 
                  LEFT JOIN departments ON lecturers.department_id = departments.id 
                  ORDER BY lecturers.id ASC";
        return $this->execute($query);
    }

    public function getLecturerById($id) {
        $query = "SELECT * FROM lecturers WHERE id = ?";
        return $this->executePrepared($query, "i", [$id]);
    }

    public function addLecturer($data) {
        $deptId = !empty($data['department_id']) ? $data['department_id'] : null;
        $query = "INSERT INTO lecturers (name, nidn, phone, join_date, department_id) VALUES (?, ?, ?, ?, ?)";
        return $this->executePrepared($query, "ssssi", [
            $data['name'], $data['nidn'], $data['phone'], $data['join_date'], $deptId
        ]);
    }

    public function updateLecturer($id, $data) {
        $deptId = !empty($data['department_id']) ? $data['department_id'] : null;
        $query = "UPDATE lecturers SET name = ?, nidn = ?, phone = ?, join_date = ?, department_id = ? WHERE id = ?";
        return $this->executePrepared($query, "ssssii", [
            $data['name'], $data['nidn'], $data['phone'], $data['join_date'], $deptId, $id
        ]);
    }

    public function deleteLecturer($id) {
        $query = "DELETE FROM lecturers WHERE id = ?";
        return $this->executePrepared($query, "i", [$id]);
    }
}
?>