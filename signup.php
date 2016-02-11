<?php
/**
 * Created by IntelliJ IDEA.
 * User: l
 * Date: 11/02/2016
 * Time: 14.45
 */
include "common.php";

$errormsg = null;
if ($_POST) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (strlen($username) < 1 || strlen($username) > 29 || strlen($password) < 1 || strlen($password) > 29)
            throw new Exception("Ugyldigt brugernavn eller kodeord");
        $data = loadData($username, $password);
        if ($data !== null)
            throw new Exception("Brugernavnet findes allerede");
        $data = [
            "password" => md5($password),
            "signup_time" => date('Y-m-d H:i:s')
        ];
        saveData($username, $data);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: start.php");
    } catch (Exception $e) {
        $errormsg = $e->getMessage();
    }

}

echo getTwig()->render('signup.twig', ['errormsg' => $errormsg]);