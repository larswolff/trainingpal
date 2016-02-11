<?php
/**
 * Created by IntelliJ IDEA.
 * User: l
 * Date: 11/02/2016
 * Time: 14.45
 */
include "common.php";

if ($_SESSION['username'])
    header("Location: start.php");

$errormsg = null;
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data = loadData($username, $password);
    if ($data !== null) {
        header("Location: start.php");
        return;
    }
    $errormsg = "Forkert brugernavn eller kodeord";
}

echo getTwig()->render('login.twig', ['errormsg' => $errormsg ]);