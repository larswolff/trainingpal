<?php
/**
 * Created by IntelliJ IDEA.
 * User: l
 * Date: 11/02/2016
 * Time: 14.45
 */
include "common.php";

$data = loadSessionDataOrLogout();
$id = $_GET['id'];
unset($data['type'][$id]);

saveSessionData($data);

header('Location: start.php');