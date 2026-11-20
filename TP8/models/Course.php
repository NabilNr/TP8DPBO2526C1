<?php
class Course extends DB {
    public function getCourses() {
        $query = "SELECT courses.*, lecturers.name AS lecturer_name 
                  FROM courses 
                  JOIN lecturers ON courses.lecturer_id = lecturers.id 
                  ORDER BY courses.id ASC";
        return $this->execute($query);
    }

    public function getCourseById($id) {
        $query = "SELECT * FROM courses WHERE id = ?";
        return $this->executePrepared($query, "i", [$id]);
    }

    public function addCourse($data) {
        $query = "INSERT INTO courses (course_code, course_name, credits, lecturer_id) VALUES (?, ?, ?, ?)";
        return $this->executePrepared($query, "ssii", [
            $data['course_code'], $data['course_name'], $data['credits'], $data['lecturer_id']
        ]);
    }

    public function updateCourse($id, $data) {
        $query = "UPDATE courses SET course_code = ?, course_name = ?, credits = ?, lecturer_id = ? WHERE id = ?";
        return $this->executePrepared($query, "ssiii", [
            $data['course_code'], $data['course_name'], $data['credits'], $data['lecturer_id'], $id
        ]);
    }

    public function deleteCourse($id) {
        $query = "DELETE FROM courses WHERE id = ?";
        return $this->executePrepared($query, "i", [$id]);
    }
}
?>