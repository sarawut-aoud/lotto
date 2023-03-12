<?php
require_once '../config/config.php';
class Dashboard_model extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->code = 200;
        $this->status = false;
    }
    public function get_data()
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
    public function save_json($post)
    {
        $type = $post['function'];
        $json_pay = json_encode($post['data'], JSON_UNESCAPED_UNICODE);
        if (self::chk_row($json_pay, $type)) {
            $str = '';
            switch ($type) {
                case "pay":
                    $str = "json_pay";
                    break;
                case "top":
                    $str = "json_top";
                    break;
                case "bottom":
                    $str = "json_bottom";
                    break;
            }

            $strSQL = "UPDATE `lotto_setting` 
                        SET `$str`='{$json_pay}' 
                        WHERE 1";
            $result = mysqli_query($this->dbcon, $strSQL);
        }
        $msg = 'Error : Data';
        if ($result) {
            $this->status = true;
            $msg = 'Success : Data';
        }
        $json = array('status' => $this->status, 'data' => $msg, 'code' => $this->code);
        return json_encode($json);
    }
    private function chk_row($data, $type)
    {
        $str = '';
        switch ($type) {
            case "pay":
                $str = "json_pay";
                break;
            case "top":
                $str = "json_top";
                break;
            case "bottom":
                $str = "json_bottom";
                break;
        }

        $result =  mysqli_query($this->dbcon, "SELECT $str FROM lotto_setting");
        $rs =  $result->fetch_all();
        if (empty($rs)) {
            $result =    mysqli_query($this->dbcon, "INSERT INTO `lotto_setting`(`$str`) VALUES ('$data')");
        }
        return true;
    }
}
