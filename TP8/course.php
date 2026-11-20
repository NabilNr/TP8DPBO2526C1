<?php
include_once("controllers/CourseController.php");

$course = new CourseController();

if (isset($_POST['submit'])) {
    $course->add($_POST);
} elseif (isset($_POST['update'])) {
    $course->edit($_POST['id'], $_POST);
} elseif (isset($_GET['add'])) {
    $course->showAddForm();
} elseif (isset($_GET['edit'])) {
    $course->showEditForm($_GET['edit']);
} elseif (isset($_GET['delete'])) {
    $course->delete($_GET['delete']);
} else {
    $course->index();
}
?>