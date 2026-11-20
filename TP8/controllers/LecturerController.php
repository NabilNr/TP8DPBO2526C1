<?php
include_once("config.php");
include_once("models/DB.php");
include_once("models/Lecturer.php");
include_once("models/Department.php");
include_once("views/Template.php");
include_once("views/LecturerView.php");

class LecturerController {
    private $lecturer;
    private $department;

    public function __construct() {
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index() {
        $this->lecturer->open();
        $this->lecturer->getLecturers();
        $data = ['lecturers' => $this->lecturer->getResult()];
        $this->lecturer->close();

        $view = new LecturerView();
        $view->render($data);
    }

    public function showAddForm() {
        $this->department->open();
        $this->department->getDepartments();
        $departments = $this->department->getResult();
        $this->department->close();

        $view = new LecturerView();
        $view->renderForm($departments, null);
    }

    public function showEditForm($id) {
        $this->lecturer->open();
        $this->lecturer->getLecturerById($id);
        $lecData = $this->lecturer->getResult();
        $this->lecturer->close();

        if (empty($lecData)) {
            header("Location: index.php");
            exit;
        }

        $this->department->open();
        $this->department->getDepartments();
        $departments = $this->department->getResult();
        $this->department->close();

        $view = new LecturerView();
        $view->renderForm($departments, $lecData[0]);
    }

    public function add($data) {
        $this->lecturer->open();
        $this->lecturer->addLecturer($data);
        $this->lecturer->close();
        header("Location: index.php");
        exit;
    }

    public function edit($id, $data) {
        $this->lecturer->open();
        $this->lecturer->updateLecturer($id, $data);
        $this->lecturer->close();
        header("Location: index.php");
        exit;
    }

    public function delete($id) {
        $this->lecturer->open();
        $this->lecturer->deleteLecturer($id);
        $this->lecturer->close();
        header("Location: index.php");
        exit;
    }
}
?>