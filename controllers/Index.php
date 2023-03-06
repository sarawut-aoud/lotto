<?php
require_once '../models/Index_model.php';

$model = new Index_model();
$post = $_REQUEST;
$func = $post['function'];
if ($func == 'pay') {
    $json_pay = $model->save_json_pay($post['data']);
    echo $json_pay;
}
if ($func == 'get') {
    $json_getdata = $model->get_data();
    echo $json_getdata;
}
