<?php
require_once '../models/Dashboard_model.php';

$model = new Dashboard_model();
$post = $_REQUEST;
$func = $post['function'];
if ($func == 'pay') {
    $json_pay = $model->save_json($post);
    echo $json_pay;
}
if ($func == 'top') {
    $json_pay = $model->save_json($post);
    echo $json_pay;
}
if ($func == 'bottom') {
    $json_pay = $model->save_json($post);
    echo $json_pay;
}
if ($func == 'get') {
    $json_getdata = $model->get_data();
    echo $json_getdata;
}
if ($func == 'date') {
    $result = $model->savedate($post);
    echo $result;
}
if ($func == 'getdate') {
    $result = $model->get_date();
    echo $result;
}
if ($func == 'getdatetable') {
    $result = $model->get_date();
    echo $result;
}
