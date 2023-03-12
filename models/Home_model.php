<?php
require_once '../config/config.php';
class Home_model extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->code = 200;
        $this->status = false;
    }
    public function loaddata()
    {
        $result =  mysqli_query($this->dbcon, "SELECT * FROM lotto_setting");

        $msg = 'Error : Data';
        $data = [];
        if (!empty($result)) {
            $this->status = true;
            $msg = 'Success : Data';
            $data = $result->fetch_object();
            $data->json_pay = json_decode($data->json_pay);
            $data->json_top = json_decode($data->json_top);
            $data->json_bottom = json_decode($data->json_bottom);
        }

        $json = array('status' => $this->status, 'data' => $data, 'code' => $this->code);
        return json_encode($json);
    }
}
