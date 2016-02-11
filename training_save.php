<?php
/**
 * Created by IntelliJ IDEA.
 * User: l
 * Date: 11/02/2016
 * Time: 14.45
 */
include "common.php";

$data = loadSessionDataOrLogout();
$id = $_POST['id'];
$value = $_POST['value'];
$date = date('Y-m-d H:i:s');
$data['type'][$id]['rows'][] =
    [
        'date' => $date,
        'value' => $value
    ];

usort($data['type'][$id]['rows'], function($a, $b) {
    if ($a['date'] < $b['date'])
        return 1;
    if ($a['date'] > $b['date'])
        return -1;
    return 0;
});

saveSessionData($data);
$_SESSION['done'][] = $id;

header('Location: start.php');