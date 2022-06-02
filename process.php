<?php
<?php

session_start();
require_once 'conn.php';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mysqli->query("INSERT INTO data (name,age,email) VALUES ('$name','$age','$email')") or die($mysqli->error);
    $_SESSION['msg'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    header("location:index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);
    $_SESSION['msg'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location:index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT*FROM data WHERE id=$id") or die($mysqli->error);
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $age =  $row['age'];
    $email = $row['email'];
} 

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mysqli->query("UPDATE data SET name='$name', age='$age', email='$email' WHERE id=$id") or die($mysqli->error);
    $_SESSION['msg'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location:index.php");
}
