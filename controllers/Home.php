<?php
require_once '../models/Home_model.php';

$model = new Home_model();
$post = $_REQUEST;
$func = $post['function'];
if ($func == 'index') {
    $json_pay = $model->loaddata();
    echo $json_pay;
}
