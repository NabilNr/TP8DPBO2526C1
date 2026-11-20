<?php
include_once("config.php");
include_once("models/DB.php");
include_once("models/Department.php");
include_once("views/Template.php");
include_once("views/DepartmentView.php");

class DepartmentController {
    private $department;

    public function __construct() {
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index() {
        $this->department->open();
        $this->department->getDepartments();
        $data = ['departments' => $this->department->getResult()];
        $this->department->close();

        $view = new DepartmentView();
        $view->render($data);
    }

    public function showAddForm() {
        $view = new DepartmentView();
        $view->renderForm(null);
    }

    public function showEditForm($id) {
        $this->department->open();
        $this->department->getDepartmentById($id);
        $deptData = $this->department->getResult();
        $this->department->close();

        if (empty($deptData)) {
            header("Location: department.php");
            exit;
        }

        $view = new DepartmentView();
        $view->renderForm($deptData[0]);
    }

    public function add($data) {
        $this->department->open();
        $this->department->addDepartment($data);
        $this->department->close();
        header("Location: department.php");
        exit;
    }

    public function edit($id, $data) {
        $this->department->open();
        $this->department->updateDepartment($id, $data);
        $this->department->close();
        header("Location: department.php");
        exit;
    }

    public function delete($id) {
        $this->department->open();
        $this->department->deleteDepartment($id);
        $this->department->close();
        header("Location: department.php");
        exit;
    }
}
?>