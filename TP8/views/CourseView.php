<?php
class CourseView {
    public function render($data) {
        $rows = "";
        foreach ($data['courses'] as $row) {
            $rows .= "<tr>
                <th>{$row['id']}</th>
                <td>" . htmlspecialchars($row['course_code']) . "</td>
                <td>" . htmlspecialchars($row['course_name']) . "</td>
                <td>{$row['credits']}</td>
                <td>" . htmlspecialchars($row['lecturer_name']) . "</td>
                <td>
                    <a class='btn btn-success btn-sm' href='course.php?edit={$row['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='course.php?delete={$row['id']}' onclick=\"return confirm('Yakin hapus mata kuliah ini?')\">Delete</a>
                </td>
            </tr>";
        }

        $contentTpl = new Template("templates/courses.html");
        $contentTpl->replace("DATA_TABEL", $rows);

        $skin = new Template("templates/skin.html");
        $skin->replace("DATA_TITLE", "Courses");
        $skin->replace("DATA_NAV_COURSE", "active");
        $skin->replace("DATA_CONTENT", $contentTpl->getContent());
        $skin->write();
    }

    public function renderForm($lecturers, $course = null) {
        $isEdit = ($course !== null);
        $options = "";
        foreach ($lecturers as $lec) {
            $selected = ($isEdit && $course['lecturer_id'] == $lec['id']) ? "selected" : "";
            $options .= "<option value='{$lec['id']}' {$selected}>" . htmlspecialchars($lec['name']) . " ({$lec['nidn']})</option>";
        }

        $formTpl = new Template("templates/course_form.html");
        $formTpl->replace("DATA_HEADER_CLASS", $isEdit ? "bg-warning" : "bg-primary");
        $formTpl->replace("DATA_FORM_TITLE", $isEdit ? "Update Course" : "Create New Course");
        $formTpl->replace("DATA_ID", $isEdit ? $course['id'] : "");
        $formTpl->replace("DATA_CODE", $isEdit ? htmlspecialchars($course['course_code']) : "");
        $formTpl->replace("DATA_NAME", $isEdit ? htmlspecialchars($course['course_name']) : "");
        $formTpl->replace("DATA_CREDITS", $isEdit ? $course['credits'] : "");
        $formTpl->replace("DATA_LECTURER_OPTIONS", $options);
        $formTpl->replace("DATA_SUBMIT_NAME", $isEdit ? "update" : "submit");

        $skin = new Template("templates/skin.html");
        $skin->replace("DATA_TITLE", $isEdit ? "Edit Course" : "Add Course");
        $skin->replace("DATA_NAV_COURSE", "active");
        $skin->replace("DATA_CONTENT", $formTpl->getContent());
        $skin->write();
    }
}
?>