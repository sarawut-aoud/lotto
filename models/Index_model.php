<?php
require_once '../config/config.php';
class Index_model extends Database
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
        }

        $json = array('status' => $this->status, 'data' => $data, 'code' => $this->code);
        return json_encode($json);
    }
    public function save_json_pay($post)
    {

        $json_pay = json_encode($post, JSON_UNESCAPED_UNICODE);
        $row = self::chk_row();
        if (empty($row)) {
            $strSQL = "INSERT INTO `lotto_setting`(`json_pay`) 
                        VALUES ('$json_pay')";
            $result =    mysqli_query($this->dbcon, $strSQL);
        } else {
            $strSQL = "UPDATE `lotto_setting` 
                        SET `json_pay`='{$json_pay}' 
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
    private function chk_row()
    {
        $result =  mysqli_query($this->dbcon, "SELECT json_pay FROM lotto_setting");
        return $result->fetch_all();
    }
}
