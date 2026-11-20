<?php
include_once("config.php");
include_once("models/DB.php");
include_once("models/Course.php");
include_once("models/Lecturer.php");
include_once("views/Template.php");
include_once("views/CourseView.php");

class CourseController {
    private $course;
    private $lecturer;

    public function __construct() {
        $this->course = new Course(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index() {
        $this->course->open();
        $this->course->getCourses();
        $data = ['courses' => $this->course->getResult()];
        $this->course->close();

        $view = new CourseView();
        $view->render($data);
    }

    public function showAddForm() {
        $this->lecturer->open();
        $this->lecturer->getLecturers();
        $lecturers = $this->lecturer->getResult();
        $this->lecturer->close();

        $view = new CourseView();
        $view->renderForm($lecturers, null);
    }

    public function showEditForm($id) {
        $this->course->open();
        $this->course->getCourseById($id);
        $courseData = $this->course->getResult();
        $this->course->close();

        if (empty($courseData)) {
            header("Location: course.php");
            exit;
        }

        $this->lecturer->open();
        $this->lecturer->getLecturers();
        $lecturers = $this->lecturer->getResult();
        $this->lecturer->close();

        $view = new CourseView();
        $view->renderForm($lecturers, $courseData[0]);
    }

    public function add($data) {
        $this->course->open();
        $this->course->addCourse($data);
        $this->course->close();
        header("Location: course.php");
        exit;
    }

    public function edit($id, $data) {
        $this->course->open();
        $this->course->updateCourse($id, $data);
        $this->course->close();
        header("Location: course.php");
        exit;
    }

    public function delete($id) {
        $this->course->open();
        $this->course->deleteCourse($id);
        $this->course->close();
        header("Location: course.php");
        exit;
    }
}
?>