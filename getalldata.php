<?php
    
    // header hasil bentukan json
    header("Content-Type: application/json");

    // tangkap metode akses    
    $method = $_SERVER['REQUEST_METHOD'];

    // variable hasil
    $result = array();

    // cek metode
    if($method=='GET'){
        //jika metode sesuai, mengeluarkan result Request Valid
        $result['status'] = [
            'code' => 200,
            'description' => 'Request Valid'
        ];

    // Menghubungkan ke server database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "daftarsekolah";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


            // query menampilkan semua data dalam table sekolah
            $sql = "SELECT * FROM sekolah";

            // eksekusi query dan simpan dalam variabel result
            $hasil_query = $conn->query($sql);
            // masukkan ke array result
            $result['results'] = $hasil_query->fetch_all(MYSQLI_ASSOC);

            
        }else{
            // jika request tidak sesuai, mengeluarkan result Request Not valid
            $result['status'] = [
                'code' => 400,
                'description' => 'Request Not Valid'
            ];
    }

    // Menampilkan data result dalam bentuk json
    echo json_encode($result);
    


?>