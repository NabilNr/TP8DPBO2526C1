<?php
include_once("controllers/DepartmentController.php");

$dept = new DepartmentController();

if (isset($_POST['submit'])) {
    $dept->add($_POST);
} elseif (isset($_POST['update'])) {
    $dept->edit($_POST['id'], $_POST);
} elseif (isset($_GET['add'])) {
    $dept->showAddForm();
} elseif (isset($_GET['edit'])) {
    $dept->showEditForm($_GET['edit']);
} elseif (isset($_GET['delete'])) {
    $dept->delete($_GET['delete']);
} else {
    $dept->index();
}
?>