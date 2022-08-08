<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>API Sekolah</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/nord.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">API Sekolah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['nama'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#getbyprovinsi" class="nav-link">
                  <p>Get by provinsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#getbykabupaten" class="nav-link">
                  <p>Get by kota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#getbykecamatan" class="nav-link">
                  <p>Get by kecamatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#getbysekolah" class="nav-link">
                  <p>Get by sekolah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#getbynpsn" class="nav-link">
                  <p>Get by npsn</p>
                </a>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="nav-icon fa fa-arrow-left" aria-hidden="true"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>API Key</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Your API key</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <?php 
          include 'connect.php';
            $sql = "SELECT * FROM apikey WHERE id_user = '$_SESSION[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Your API key is: <b>" . $row["token"] . "</b></p>";
            } else {
                echo "<b>You don't have an API key yet!</b>";
                echo "<p>Click below to generate one.</p>";
                echo "<div class='row'><div class='col-2'><button type='button' class='btn btn-block btn-info' id='generate_key'>Generate API Key</button></div></div>";
            }
          ?>
        </div>
      </div>

      <div class="card" id="getbyprovinsi">
        <div class="card-header">
          <h3 class="card-title">Get by provinsi</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Method</th>
                    <th>Parameter</th>
                    <th>Wajib</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>GET/HEAD</td>
                    <td>token</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>API Key/Token</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td>kode_prop</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>Parameter API</td>
                </tr>
                </tbody>
            </table><hr>
            <h5>Example Url :</h5>
            <p>http://localhost/apisekolah/getbyprovinsi.php?kode_prop=010000</p>
            <h5>Response</h5>
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo" class="p-3">
{
    "status": {
        "code": 200,
        "description": "Request Valid"
    },
    "results": [
        {
            "kode_prop": "010000  ",
            "propinsi": "Prov. D.K.I. Jakarta",
            "kode_kab_kota": "010100  ",
            "kabupaten_kota": "Kab. Kepulauan Seribu",
            "kode_kec": "010101  ",
            "kecamatan": "Kec. Kepulauan Seribu Selatan",
            "id": "40C6E595-2BF5-E011-B2F2-796762867641",
            "npsn": "20106343",
            "sekolah": "SMP NEGERI 241",
            "bentuk": "SMP",
            "status": "N",
            "alamat_jalan": "Jl. Pendidikan",
            "lintang": "-5.7985000",
            "bujur": "106.5003000"
        }
    ]
}
              </textarea>
            </div>
        </div>
      </div>

      <div class="card" id="getbykabupaten">
        <div class="card-header">
          <h3 class="card-title">Get by kota</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Method</th>
                    <th>Parameter</th>
                    <th>Wajib</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>GET/HEAD</td>
                    <td>token</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>API Key/Token</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td>kode_kab_kota</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>Parameter API</td>
                </tr>
                </tbody>
            </table><hr>
            <h5>Example Url :</h5>
            <p>http://localhost/apisekolah/getbykota.php?kode_kab_kota=010100</p>
            <h5>Response</h5>
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo2" class="p-3">
{
    "status": {
        "code": 200,
        "description": "Request Valid"
    },
    "results": [
        {
            "kode_prop": "010000  ",
            "propinsi": "Prov. D.K.I. Jakarta",
            "kode_kab_kota": "010100  ",
            "kabupaten_kota": "Kab. Kepulauan Seribu",
            "kode_kec": "010101  ",
            "kecamatan": "Kec. Kepulauan Seribu Selatan",
            "id": "40C6E595-2BF5-E011-B2F2-796762867641",
            "npsn": "20106343",
            "sekolah": "SMP NEGERI 241",
            "bentuk": "SMP",
            "status": "N",
            "alamat_jalan": "Jl. Pendidikan",
            "lintang": "-5.7985000",
            "bujur": "106.5003000"
        }
    ]
}
              </textarea>
            </div>
        </div>
      </div>

      <div class="card" id="getbykecamatan">
        <div class="card-header">
          <h3 class="card-title">Get by kecamatan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Method</th>
                    <th>Parameter</th>
                    <th>Wajib</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>GET/HEAD</td>
                    <td>token</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>API Key/Token</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td>kode_kec</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>Parameter API</td>
                </tr>
                </tbody>
            </table><hr>
            <h5>Example Url :</h5>
            <p>http://localhost/apisekolah/getbykecamatan.php?kode_kec=016007</p>
            <h5>Response</h5>
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo3" class="p-3">
{
    "status": {
        "code": 200,
        "description": "Request Valid"
    },
    "results": [
        {
            "kode_prop": "010000  ",
            "propinsi": "Prov. D.K.I. Jakarta",
            "kode_kab_kota": "016000  ",
            "kabupaten_kota": "Kota Jakarta Pusat",
            "kode_kec": "016007  ",
            "kecamatan": "Kec. Sawah Besar",
            "id": "03177E51-BB30-4A4E-9E06-044E74025959",
            "npsn": "20107258",
            "sekolah": "SMKS STRADA JAKARTA",
            "bentuk": "SMK",
            "status": "S",
            "alamat_jalan": "JL. RAJAWALI SELATAN 2 NO. 1",
            "lintang": "-6.1462000",
            "bujur": "106.8393000"
        }
    ]
}
              </textarea>
            </div>
        </div>
      </div>

      <div class="card" id="getbysekolah">
        <div class="card-header">
          <h3 class="card-title">Get by sekolah</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Method</th>
                    <th>Parameter</th>
                    <th>Wajib</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>GET/HEAD</td>
                    <td>token</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>API Key/Token</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td>sekolah</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>Parameter API</td>
                </tr>
                </tbody>
            </table><hr>
            <h5>Example Url :</h5>
            <p>http://localhost/apisekolah/getbysekolah.php?sekolah=SDN I</p>
            <h5>Response</h5>
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo4" class="p-3">
{
    "status": {
        "code": 200,
        "description": "Request Valid"
    },
    "results": [
        {
            "kode_prop": "010000  ",
            "propinsi": "Prov. D.K.I. Jakarta",
            "kode_kab_kota": "010100  ",
            "kabupaten_kota": "Kab. Kepulauan Seribu",
            "kode_kec": "010101  ",
            "kecamatan": "Kec. Kepulauan Seribu Selatan",
            "id": "40C6E595-2BF5-E011-B2F2-796762867641",
            "npsn": "20106343",
            "sekolah": "SMP NEGERI 241",
            "bentuk": "SMP",
            "status": "N",
            "alamat_jalan": "Jl. Pendidikan",
            "lintang": "-5.7985000",
            "bujur": "106.5003000"
        }
    ]  
}
              </textarea>
            </div>
        </div>
      </div>
      <div class="card" id="getbynpsn">
        <div class="card-header">
          <h3 class="card-title">Get by npsn sekolah</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Method</th>
                    <th>Parameter</th>
                    <th>Wajib</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>GET/HEAD</td>
                    <td>token</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>API Key/Token</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td>npsn</td>
                    <td>YA</td>
                    <td>String</td>
                    <td>Parameter API</td>
                </tr>
                </tbody>
            </table><hr>
            <h5>Example Url :</h5>
            <p>http://localhost/apisekolah/selectonedata.php?npsn=20106343</p>
            <h5>Response</h5>
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo5" class="p-3">
{
    "status": {
        "code": 200,
        "description": "Request Valid"
    },
    "results": [
        {
            "kode_prop": "010000  ",
            "propinsi": "Prov. D.K.I. Jakarta",
            "kode_kab_kota": "010100  ",
            "kabupaten_kota": "Kab. Kepulauan Seribu",
            "kode_kec": "010101  ",
            "kecamatan": "Kec. Kepulauan Seribu Selatan",
            "id": "40C6E595-2BF5-E011-B2F2-796762867641",
            "npsn": "20106343",
            "sekolah": "SMP NEGERI 241",
            "bentuk": "SMP",
            "status": "N",
            "alamat_jalan": "Jl. Pendidikan",
            "lintang": "-5.7985000",
            "bujur": "106.5003000"
        }
    ]  
}
              </textarea>
            </div>
        </div>
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2022 <a href="#">Kelompok 4</a>.</strong> API Daftar Sekolah.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script>
  $(function () {
    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "nord"
    });
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo2"), {
      mode: "htmlmixed",
      theme: "nord"
    });
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo3"), {
      mode: "htmlmixed",
      theme: "nord"
    });
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo4"), {
      mode: "htmlmixed",
      theme: "nord"
    });
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo5"), {
      mode: "htmlmixed",
      theme: "nord"
    });
  })
</script>
<script>

    $("#generate_key").click(function(){
        $.ajax({
        url: 'generate_key.php',
        type: 'POST',
        data: {
            id: "<?=$_SESSION['id']?>",
            username: "<?=$_SESSION['username']?>"
        },
        success: function(data) {
            // console.log(data);
            location.reload();
        }
        });
  });
</script>
</body>
</html>
