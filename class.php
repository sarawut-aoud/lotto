<?php
require_once './config.php';
class searchdata extends Database
{
    public function select()
    {


        $result = mysqli_query($this->dbcon, "SELECT t1.id ,t2.id as class ,t1.emp
        FROM employee t1
        LEFT JOIN activity t2 ON t2.id = t1.class WHERE status_show ='active' AND listrow ='1' ORDER BY t2.id ASC");
        $data =  [];
        $i = 0;
        while ($row = $result->fetch_object()) {
            $data[$i] = (object) array(
                "id" => intval($row->id),
                "name" => $row->emp,
                "list" => intval($row->class),

            );
            $i++;
        }

        return $data;
    }
    public function activity()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM activity WHERE listrow ='1' ");
        return $result;
    }
    public function activity2()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM activity WHERE listrow ='1' ");
        $data =  [];
        $i = 0;
        while ($row = $result->fetch_object()) {
            $data[$i] = (object) array(
                "class" => intval($row->id),
                "name" => $row->name,
            );
            $i++;
        }

        return $data;
    }

    public function employee()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM employee WHERE status_show = 'active' ORDER BY class ASC");
        $data = [];
        $i = 0;
        while ($row = $result->fetch_object()) {
            $data[$i] = $row;
            $data[$i]->activity = self::get_activity($data[$i]->class);
            $i++;
        }

        return $data;
    }
    private function get_activity($id)
    {
        $rs = $this->activity_check($id);
        return $rs;
    }
    public function activity_check($id)
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM activity WHERE listrow ='1' ");
        $data =  [];
        $i = 0;
        while ($row = $result->fetch_object()) {
            $data[$i] = (object) array(
                "class" => intval($row->id),
                "name" => $row->name,
                "classname" => $row->id == $id ? 'bg-success' : '',
            );
            $i++;
        }

        return $data;
    }
    public function login_admin($post)
    {

        $data = (object)array(
            'username' => $post['username'],
            'password' => base64_encode(md5(trim(urldecode(base64_decode($post['password'])))))
        );

        $msg = '';
        $result = '';
        $url = '';
        if (!$data->username || !$data->password) {
            $msg = 'กรอก username หรือ password ไม่ครบ';
            $code = 0;
            $result =  'error';
        } else {
            $password = self::get_password($data->username);
            if ($password != $data->password) {
                $msg = 'Password ไม่ถูกต้อง';
                $code = 200;
                $result =  'error';
            } else {
                $query = mysqli_query($this->dbcon, "SELECT * FROM users WHERE username = '{$data->username}' AND password = '{$data->password}'");
                if ($query) {
                    $msg = 'Login Successfuly';
                    $code = 200;
                    $result =  'success';
                    session_start();
                    $_SESSION['username'] = 'admin';
                    $_SESSION['Is_admin'] = '1';
                    $url = './admin.php';
                } else {
                    $msg = 'Login Failed';
                    $code = 200;
                    $result =  'Failed';
                }
            }
        }


        $json = json_encode(array(
            'message'   => $msg,
            'code'      => $code,
            'result'    => $result,
            'url'       => $url,
        ));
        return  $json;
    }
    private function get_password($username)
    {
        $query =  mysqli_query($this->dbcon, "SELECT * FROM users WHERE username = '{$username}' ");

        return $query->fetch_object()->password;
    }
    public function http_code($method)
    {
        switch ($method) {
            case 0:
                $res = http_response_code(0);
                break;
            case 200:
                $res = http_response_code(200);
                break;
            default:
                $res = http_response_code(400);
        }
        return $res;
    }
    public function adddata()
    {
        $date1 = date('Y-m-d');
        $sql = mysqli_query($this->dbcon, "SELECT * FROM employee WHERE status_show = 'active'");
        $i = 0;
        $data = array();
        while ($row = $sql->fetch_object()) {
            $data[$i] = $row;
            $i++;
        }
        foreach ($data as $key => $val) {

            $class = $val->class + 1;
            // if ($class == 4) {
            //     mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '5' WHERE id = '$val->id' ");
            // }
            if ($class == 7) {
                mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '8' WHERE id = '$val->id' ");
            }
            if ($class  >= 8) {
                mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '1' WHERE id = '$val->id' ");
            }
            if ($class < 8  &&  $class != 7) {

                mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '$class' WHERE id = '$val->id' ");
            }
        }
        $json = json_encode(array(
            'code'      => 200,
            'message'    => 'success',
            'is_successfully' => true,
        ));
        return $json;
    }
    public function set_data()
    {
        $date1 = date('Y-m-d');
        $sql = mysqli_query($this->dbcon, "SELECT * FROM employee WHERE status_show = 'active'");
        $i = 0;
        $data = array();
        while ($row = $sql->fetch_object()) {
            $data[$i] = $row;
            $i++;
        }
        foreach ($data as $key => $val) {

            $class = $val->class + 1;
            // if ($class == 4) {
            //     mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '5' WHERE id = '$val->id' ");
            // }
            if ($class == 7) {
                mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '8' WHERE id = '$val->id' ");
            }
            if ($class  >= 8) {
                mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '1' WHERE id = '$val->id' ");
            }
            if ($class < 8  &&  $class != 7) {

                mysqli_query($this->dbcon, "UPDATE `employee` SET `date` = '$date1' , `class` = '$class' WHERE id = '$val->id' ");
            }
        }
        $json = json_encode(array(
            'code'      => 200,
            'message'    => 'success',
            'is_successfully' => true,
        ));
        return $json;
    }
}
