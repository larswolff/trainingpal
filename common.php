<?php
include "vendor/autoload.php";

session_start();

/**
 * @return Twig_Environment
 */
function getTwig()
{
    static $twig = false;
    if ($twig !== false)
        return $twig;
    $loader = new Twig_Loader_Filesystem(__DIR__."/twig");
    $twig = new Twig_Environment($loader);
    return $twig;
}

function calcDataFilenameFromUsername($username)
{
    return __DIR__."/data/".md5($username);
}

function loadData($username, $password)
{
    $file = calcDataFilenameFromUsername($username);
    if (file_exists($file)) {
        $data = unserialize(file_get_contents($file));
    } else {
        return null;
    }
    if (md5($password) !== $data['password'])
        return null;
    return $data;
}

function saveData($username, $data)
{
    $file = calcDataFilenameFromUsername($username);
    file_put_contents($file, serialize($data));
}

function saveSessionData($data)
{
    saveData($_SESSION['username'], $data);
}

function loadSessionDataOrLogout()
{
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        logout();
    }
    $data = loadData($_SESSION['username'], $_SESSION['password']);
    if ($data === null)
        logout();
    return $data;
}

function logout()
{
    foreach(array_keys($_SESSION) as $key)
        unset($_SESSION[$key]);
    header('Location: index.php');
    die;
}