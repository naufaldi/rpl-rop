<head>
    <meta charset="utf-8">
    <title>Penyediaan Barang dengan Reorder Point</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
      <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
      <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
      <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>
  <body>
<?php
	session_start(); 		//mulai session, krena kita akan menggunakan session pd file php ini
	include 'koneksi.php'; 		//hubungkan dengan koneksi.php untuk berhubungan dengan database
	$db = new database();
	$db->connectMySQL();
	$username=$_POST['username']; 	//tangkap data yg di input dari form login input username
	$password=$_POST['password']; 	//tangkap data yg di input dari form login input password
 	$level=$_POST['level'];

	$query=mysql_query("select * from pengguna where username='$username' and password='$password' and level='$level'");	 //melakukan pengampilan data dari database untuk di cocokkan
	$ok=mysql_num_rows($query);	 //melakukan pencocokan
	if($ok==TRUE){ 		// melakukan pemeriksaan kecocokan dengan percabangan.
		$_SESSION['username']=$username;  //jika cocok, buat session dengan nama sesuai dengan username
		echo "<script>window.location.href = 'index.php'</script>";     // dan alihkan ke index.php
	}else{   				//jika tidak tampilkan pesan gagal login
		echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>";
		include_once "login.php";
	}
 
?>
<script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
  
     <script src="assets/js/bootstrap.min.js"></script>
</body>