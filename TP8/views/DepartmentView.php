<?php
class DepartmentView {
    public function render($data) {
        $rows = "";
        foreach ($data['departments'] as $row) {
            $rows .= "<tr>
                <th>{$row['id']}</th>
                <td>" . htmlspecialchars($row['dept_name']) . "</td>
                <td>" . htmlspecialchars($row['faculty']) . "</td>
                <td>
                    <a class='btn btn-success btn-sm' href='department.php?edit={$row['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='department.php?delete={$row['id']}' onclick=\"return confirm('Yakin hapus departemen ini?')\">Delete</a>
                </td>
            </tr>";
        }

        $contentTpl = new Template("templates/departments.html");
        $contentTpl->replace("DATA_TABEL", $rows);

        $skin = new Template("templates/skin.html");
        $skin->replace("DATA_TITLE", "Departments");
        $skin->replace("DATA_NAV_DEPT", "active");
        $skin->replace("DATA_CONTENT", $contentTpl->getContent());
        $skin->write();
    }

    public function renderForm($department = null) {
        $isEdit = ($department !== null);

        $formTpl = new Template("templates/department_form.html");
        $formTpl->replace("DATA_HEADER_CLASS", $isEdit ? "bg-warning" : "bg-primary");
        $formTpl->replace("DATA_FORM_TITLE", $isEdit ? "Update Department" : "Create New Department");
        $formTpl->replace("DATA_ID", $isEdit ? $department['id'] : "");
        $formTpl->replace("DATA_DEPT_NAME", $isEdit ? htmlspecialchars($department['dept_name']) : "");
        $formTpl->replace("DATA_FACULTY", $isEdit ? htmlspecialchars($department['faculty']) : "");
        $formTpl->replace("DATA_SUBMIT_NAME", $isEdit ? "update" : "submit");

        $skin = new Template("templates/skin.html");
        $skin->replace("DATA_TITLE", $isEdit ? "Edit Department" : "Add Department");
        $skin->replace("DATA_NAV_DEPT", "active");
        $skin->replace("DATA_CONTENT", $formTpl->getContent());
        $skin->write();
    }
}
?>