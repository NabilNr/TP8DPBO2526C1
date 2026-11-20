<?php
class LecturerView {
    public function render($data) {
        $rows = "";
        foreach ($data['lecturers'] as $row) {
            $dept = $row['dept_name'] ? htmlspecialchars($row['dept_name']) : '-';
            $rows .= "<tr>
                <th>{$row['id']}</th>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['nidn']) . "</td>
                <td>" . htmlspecialchars($row['phone']) . "</td>
                <td>" . htmlspecialchars($row['join_date']) . "</td>
                <td>{$dept}</td>
                <td>
                    <a class='btn btn-success btn-sm' href='index.php?edit={$row['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='index.php?delete={$row['id']}' onclick=\"return confirm('Yakin hapus data ini?')\">Delete</a>
                </td>
            </tr>";
        }

        $contentTpl = new Template("templates/lecturers.html");
        $contentTpl->replace("DATA_TABEL", $rows);

        $skin = new Template("templates/skin.html");
        $skin->replace("DATA_TITLE", "Lecturers");
        $skin->replace("DATA_NAV_LECTURER", "active");
        $skin->replace("DATA_CONTENT", $contentTpl->getContent());
        $skin->write();
    }

    public function renderForm($departments, $lecturer = null) {
        $isEdit = ($lecturer !== null);
        $options = "";
        foreach ($departments as $dept) {
            $selected = ($isEdit && $lecturer['department_id'] == $dept['id']) ? "selected" : "";
            $options .= "<option value='{$dept['id']}' {$selected}>" . htmlspecialchars($dept['dept_name']) . " ({$dept['faculty']})</option>";
        }

        $formTpl = new Template("templates/lecturer_form.html");
        $formTpl->replace("DATA_HEADER_CLASS", $isEdit ? "bg-warning" : "bg-primary");
        $formTpl->replace("DATA_FORM_TITLE", $isEdit ? "Update Lecturer" : "Create New Lecturer");
        $formTpl->replace("DATA_ID", $isEdit ? $lecturer['id'] : "");
        $formTpl->replace("DATA_NAME", $isEdit ? htmlspecialchars($lecturer['name']) : "");
        $formTpl->replace("DATA_NIDN", $isEdit ? htmlspecialchars($lecturer['nidn']) : "");
        $formTpl->replace("DATA_PHONE", $isEdit ? htmlspecialchars($lecturer['phone']) : "");
        $formTpl->replace("DATA_JOIN_DATE", $isEdit ? $lecturer['join_date'] : "");
        $formTpl->replace("DATA_DEPT_OPTIONS", $options);
        $formTpl->replace("DATA_SUBMIT_NAME", $isEdit ? "update" : "submit");

        $skin = new Template("templates/skin.html");
        $skin->replace("DATA_TITLE", $isEdit ? "Edit Lecturer" : "Add Lecturer");
        $skin->replace("DATA_NAV_LECTURER", "active");
        $skin->replace("DATA_CONTENT", $formTpl->getContent());
        $skin->write();
    }
}
?>