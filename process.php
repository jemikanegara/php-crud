<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '123456', 'crud') or die(mysqli_error($mysqli));

$location = '';
$name = '';
$id = 0;
$update = false;

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO user (name, location) VALUES ('$name', '$location') ") or die($mysqli->error);

    $_SESSION['message'] = 'User saved successfully';

    session_write_close();
    header('Location: index.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM user WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = 'User deleted successfully';

    session_write_close();
    header('Location: index.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM user WHERE id=$id") or die($mysqli->error);
    if ($result->num_rows) {
        $update = true;
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE user SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = 'User has been updated';

    session_write_close();
    header('Location: index.php');
}
