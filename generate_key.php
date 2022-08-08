<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['username'])){
        $username= $_POST['username'];
        $id= $_POST['id'];
        $selectusersql = "SELECT * FROM user WHERE id='$id'";
        $selectuserresult = mysqli_query($conn, $selectusersql);
        $selectuser = mysqli_fetch_assoc($selectuserresult);
        $password = $selectuser['password'];
        $token = md5($username.$password);
        $sql = "INSERT INTO apikey (id_user, token) VALUES ('$id', '$token')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $res = array(
                'status' => 'success',
                'message' => 'Berhasil generate API Key'
            );
            print_r(json_encode($res));
        }else{
            $res = array(
                'status' => 'error',
                'message' => 'Gagal generate API Key'
            );
            echo json_encode($res);
        }
    }
}
?>