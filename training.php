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
$rows = $data['type'][$id]['rows'];

if (sizeof($rows) === 0)
    $rows = null;

$render = [
    "rows" => $rows,
    "title" => $data['type'][$id]['title'],
    'id' => $id
];

echo getTwig()->render('index.twig', ['content' =>
    getTwig()->render("training.twig", $render
    )
]);