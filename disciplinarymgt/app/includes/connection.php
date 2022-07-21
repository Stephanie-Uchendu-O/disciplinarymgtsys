<?php

$sitename = "Disciplinary Management System";
$conn = mysqli_connect("localhost", "root", "", "dismgt");
if (!$conn) {
    die(mysqli_error($conn) . "Error connecting Database!");
}
?>