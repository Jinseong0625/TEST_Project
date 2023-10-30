<?php 
namespace DBManager;
require __DIR__ .'/DBConnector.php';

use DBConnector;
use Firebase\JWT\JWT;

class DBHandler extends DBConnector{

    // 회원 정보 가지고 오기
    public function sp_select_User($uid)
    {
        $error = "E0000";

        if (!($stmt = $this->db->prepare("CALL sp_select_User(?)"))) {
            $error = "E1000"; // Prepare failed
        }
        if (!$stmt->bind_param("s", $uid)) {
            $error = "E1001"; // Bind failed
        }
        if (!$stmt->execute()) {
            $error = "E1002"; // Execute failed
        }

        $res = $stmt->get_result();
        $data = array();

        while($row = $res->fetch_assoc()){
            $data[] = $row;
        }

        $json_data = array(
            "error" => $error,
            "data" => $data
        );

        return json_encode($json_data);
    }

    // 회원 정보 저장하기
    public function sp_insert_User($birthday,$name,$nickname,$phone)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_User(?,?,?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("ssss", $birthday,$name,$nickname,$phone)){
            $error = "E1001";
        }
        if(!$stmt->execute()){
            $error = "E1002";
        }

        $res = $stmt->get_result();
        $data = array();

        while($row = $res->fetch_assoc()){
            $data[] = $row;
        }

        $json_data = array
        (
            "error" => $error,
            "data" => $data
        );

        return $json_data;
    }
    
}

?>