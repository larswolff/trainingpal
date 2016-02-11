<?php
/**
 * Created by IntelliJ IDEA.
 * User: l
 * Date: 11/02/2016
 * Time: 14.45
 */
include "common.php";

$data = loadSessionDataOrLogout();

$rows = [];
if (isset($data['type'])) {
    foreach ($data['type'] as $key => $value) {
        if (isset($_SESSION['done']) && in_array($key, $_SESSION['done'], true))
            continue;
        $rows[] = [
            'link' => "training.php?id={$key}",
            'title' => $value['title']
        ];
    }
}

if (sizeof($rows) === 0)
    $rows = null;

$render['username'] = $_SESSION['username'];
$render['rows'] = $rows;

echo getTwig()->render('index.twig', ['content' =>
    getTwig()->render('start.twig', $render)]
);