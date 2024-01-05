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

        if (!($stmt = $this->db->prepare("CALL sp_select_user(?)"))) {
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
    public function sp_insert_User($UUID,$PLATFORM,$nickname,$Gourmet_Points)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_User(?,?,?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("sssi", $UUID,$PLATFORM,$nickname,$Gourmet_Points)){
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

    // 가게 카테고리 정보 저장하기
    public function sp_insert_shop_category($name,$type)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_category(?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("si", $name,$type)){
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

    // 메뉴 카테고리 정보 저장하기
    public function sp_insert_menu_category($sidx,$name,$type)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_category(?,?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("ssi", $sidx,$name,$type)){
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

    // 게시판 작성하기
    public function sp_insert_board($title,$body)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_board(?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("ss", $title,$body)){
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

    // 주문하기
    public function sp_insert_order($name,$type,$uid)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_order(?,?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("ssi", $name,$type,$uid)){
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
    
    // 메뉴 작성
    public function sp_insert_menu($description,$name,$price,$image_url,$category_id)
    {
        $error = "E0000";

        if(!($stmt = $this->db->prepare("CALL sp_insert_menu(?,?,?,?,?)"))){
            $error = "E1000";
        }
        if(!$stmt->bind_param("ssisi", $description,$name,$price,$image_url,$category_id)){
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