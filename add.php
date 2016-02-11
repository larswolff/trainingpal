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
    $data = loadSessionDataOrLogout();
    try {
        $name = $_POST['name'];
        if (strlen($name) < 1 || strlen($name) > 29)
            throw new Exception("Ugyldigt navn");
        if (isset($data['type'][md5($name)]))
            throw new Exception("Den findes!");
        $data['type'][md5($name)] = [
            'rows' => [],
            'title' => $name
        ];
        saveSessionData($data);
        header("Location: start.php");
    } catch (Exception $e) {
        $errormsg = $e->getMessage();
    }

}

$render['username'] = $_SESSION['username'];
$render['errormsg'] = $errormsg;

echo getTwig()->render('index.twig', ['content' =>
        getTwig()->render('add.twig', $render)]
);