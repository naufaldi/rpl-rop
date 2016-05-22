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


if(isset($_SESSION['username'])) {
header('location:index.php'); }
require_once("koneksi.php");
$db = new database();
$db->connectMySQL();

?>

<title>Form Login</title>

<center>
   <form action="aksi-login.php" method="post">
     <h1>Masuk</h1>
     <table>
       <tbody>
         <tr><td>User Name</td><td> : <input name="username" type="text"></td></tr>
         <tr><td>Password</td><td> : <input name="password" type="password"></td></tr>
         <tr><td>Level</td><td> : <input name="level" type="text"></td></tr>
         <tr><td colspan="2" align="right"><input value="Login" type="submit"></td></tr>
       </tbody>
     </table>
   </form>
</center>


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