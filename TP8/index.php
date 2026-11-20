<?php
include_once("controllers/LecturerController.php");

$lecturer = new LecturerController();

if (isset($_POST['submit'])) {
    $lecturer->add($_POST);
} elseif (isset($_POST['update'])) {
    $lecturer->edit($_POST['id'], $_POST);
} elseif (isset($_GET['add'])) {
    $lecturer->showAddForm();
} elseif (isset($_GET['edit'])) {
    $lecturer->showEditForm($_GET['edit']);
} elseif (isset($_GET['delete'])) {
    $lecturer->delete($_GET['delete']);
} else {
    $lecturer->index();
}
?>