<?php
include '../function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];

    if ($type == 'addnewHotel') {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $description = $_POST['description'];
        $userid = getIdByUserName($_SESSION['username']);
        $result = setNewHotel($name, $address, $description, $userid);
        $data = array();
        
        if ($result == '1') {
            $data = [
                'status' => '1',
                'msg' => 'Added'
            ]; 
        } else {
            $data = [
                'status' => '0',
                'msg' => 'Something went wrong!'
            ]; 
        }
        echo json_encode($data);
    }

    if ($type == 'loadHotelDetails') {
        $data = getHotelDetails();
        echo json_encode($data);
    }

    if ($type == 'getSingleHotelDetails') {
        $id = $_POST['id'];
        $data = getHotelDetails($id);
        echo json_encode($data);
    }

    if ($type == 'updateHotelForm') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $description = $_POST['description'];
        $userid = getIdByUserName($_SESSION['username']);
        $ownerid = gettOwnerIdFromId($id);
  
        if ($ownerid == $userid) {
            $res = updateHotelDetails($id, $name, $address, $description);
            $data = array();
            if ($res) {
                $data = [
                    'status' => '1',
                    'msg' => 'Updated'
                ];
            }
        } else {
            $data = [
                'status' => '0',
                'msg' => 'Unauthorized'
            ];
        }
        echo json_encode($data);
    }
    if($type == 'deleteHotel'){
        $id = $_POST['id'];
        $userid = getIdByUserName($_SESSION['username']);
        $ownerid = gettOwnerIdFromId($id);
        if ($ownerid == $userid) {
            $res = deleteHotelDetails($id);
            $data = array();
            if ($res) {
                $data = [
                    'status' => '1',
                    'msg' => 'Deleted'
                ];
            }
        }
        else {
            $data = [
                'status' => '0',
                'msg' => 'Unauthorized'
            ];
        }
        echo json_encode($data);
    }
}
?>
