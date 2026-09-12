<?php

$tmpViews = '/tmp/laravel/views';

if (!is_dir($tmpViews)) {
    mkdir($tmpViews, 0777, true);
}

putenv("VIEW_COMPILED_PATH={$tmpViews}");
$_ENV['VIEW_COMPILED_PATH'] = $tmpViews;
$_SERVER['VIEW_COMPILED_PATH'] = $tmpViews;

require __DIR__ . '/../public/index.php';