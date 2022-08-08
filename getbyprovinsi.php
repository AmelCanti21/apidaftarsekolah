<?php
    include 'connect.php';
    // header hasil bentukan json
    header("Content-Type: application/json");

    // tangkap key
    $header = apache_request_headers();
    if (isset($header['token'])) {
        $key = $header['token'];
    } else {
        $key = "";
    }

    // tangkap metode akses    
    $method = $_SERVER['REQUEST_METHOD'];

    // inisialisasi variable hasil yaitu variable result dengan tipe data array
    $result = array();

    // cek user
    $sqluser = "SELECT * FROM apikey WHERE token = '$key'";
    $user = $conn->query($sqluser);
    if ($user->num_rows > 0) {
        // cek metode request http apakah sudah sesuai atau tidak
        if($method=='GET'){
            //cek parameter request dengan parameter prop
            if(isset($_GET['kode_prop'])){
                //mengambil parameter prop dan simpan dalam variabel kode_prop
                $kode_prop = $_GET['kode_prop'];
                //jika metode dan parameter sesuai maka akan menambahkan deskripsi Request Valid ke array result
                $result['status'] = [
                    'code' => 200,
                    'description' => 'Request Valid'
                ];
                
        
                // query menampilkan data dalam table sekolah berdasarkan kode_prop yang dikirimkan melalui method GET
                $sql = "SELECT * FROM sekolah WHERE kode_prop='$kode_prop'";

                // eksekusi query dan simpan dalam variabel result
                $hasil_query = $conn->query($sql);
                // masukkan ke array result
                $result['results'] = $hasil_query->fetch_all(MYSQLI_ASSOC);
            }else{
                //jika parameter tidak sesuai maka akan menambahkan deskripsi Parameter invalid ke array result
                $result['status'] = [
                'code' => 200,
                'description' => 'Parameter Invalid'
                ];
            }
            //echo $nim;die;
        }else{
            //jika metode tidak sesuai maka akan menambahkan deskripsi Request Not Valid ke array result
            $result['status'] = [
                'code' => 400,
                'description' => 'Request Not Valid'
            ];
        }
    }else{
        //jika metode tidak sesuai maka akan menambahkan deskripsi Request Not Valid ke array result
        $result['status'] = [
            'code' => 400,
            'description' => 'API Key/Token Not Valid'
        ];
    }

    // Menampilkan data result dalam bentuk json
    echo json_encode($result);
    


?>