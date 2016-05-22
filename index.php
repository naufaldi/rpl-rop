<!DOCTYPE html>
<html lang="en">
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
 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand">Penyediaan Barang dengan Reorder Point</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="logout.php">Logout</a></li>

<a href='?aksi=tambah'><button type='submit' class='btn btn-primary'>Tambah Produksi</button></a>
<a href='?aksi=tambahbahan'><button type='submit' class='btn btn-primary'>Tambah Bahan</button></a>
<a href='?aksi=hitung'><button type='submit' class='btn btn-primary'>Reorder Point</button></a>
<a href='?aksi=tampilkanrop'><button type='submit' class='btn btn-primary'>View Reorder Point</button></a>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

	<div class="container">
<?php
// memanggil file koneksi
include 'koneksi.php';

      session_start();
      if(empty($_SESSION['username'])){
        header("location: login.php");
      }

// instance objek db
$db = new database();
$reorder = new rop();

// koneksi ke MySQL via method
$db->connectMySQL();

// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // baca ID dari parameter ID Biodata yang akan dihapus
        $id = $_GET['id_b'];

        // proses hapus data biodata berdasarkan ID via method
        $db->hapusBiodata($id);
    } elseif ($_GET['aksi'] == 'tambah') {
        echo"<br>
<form method=POST action='?aksi=tambahBiodata'>
<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
<tr><td>Tanggal</td><td><input type=text name='tanggal'></td></tr>
<tr><td>Jumlah</td><td><input type=text name='jumlah'></td></tr>
<tr><td>Kode Produk</td><td><input type=text name='kodeproduk' ></td></tr>
<tr><td>Nama Produk</td><td><textarea type=text name='namaproduk'></textarea></td></tr>

<tr><td></td><td><button type='submit' class='btn btn-primary'>SIMPAN</button></td></tr>
</table>
</form>
";
    } elseif ($_GET['aksi'] == 'tambahBiodata') {
        $tgl = $_POST['tanggal'];
		    $jml = $_POST['jumlah'];
		    $kp = $_POST['kodeproduk'];
        $np = $_POST['namaproduk'];
		
        $db->tambahBiodata($tgl,$jml,$kp,$np);
    }
// proses edit data
    else if ($_GET['aksi'] == 'edit') {
        // baca ID Biodata yang akan di edit
        $id = $_GET['id_b'];

// menampilkan form edit Biodata pakai method bacaBiodata()
        ?>	

        <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>?aksi=update">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                <tr><td>Tanggal</td><td>:</td>
                    <td>
                      <input type="date" name="tanggal" value="<?php echo $db->bacaDataBiodata('tanggal_pro', $id); ?>">
                    </td>
                </tr>
				
				<tr><td>Jumlah</td><td>:</td>
                    <td><input type="text" name="jumlah" value="<?php echo $db->bacaDataBiodata('jumlah_pro', $id); ?>"></td>
                </tr>
				
				<tr><td>Kode Produk</td><td>:</td>
                    <td><input type="text" name="kodeproduk" value="<?php echo $db->bacaDataBiodata('kodeproduk_pro', $id); ?>"></td>
                </tr>
				
                <tr><td>Nama Produk</td><td>:</td>
                    <td><input type="text" name="namaproduk" size="40" value="<?php echo $db->bacaDataBiodata('namaproduk_pro', $id); ?>"></td>
                </tr>
				 
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <td><button type='submit' class='btn btn-primary'>UPDATE</button></td>
        </form>

        <?php
    } else if ($_GET['aksi'] == 'update') {
        // proses update data biodata
        $id_b = $_POST['id'];
        $tgl = $_POST['tanggal'];
		    $jml = $_POST['jumlah'];
		    $kp = $_POST['kodeproduk'];
        $np = $_POST['namaproduk'];
        // update data via method
        $db->updateDataBiodata($id_b,$tgl,$jml,$kp,$np);
    }
//=======================================================
    elseif ($_GET['aksi'] == 'hapusrop') {
        // baca ID dari parameter ID Biodata yang akan dihapus
        $id = $_GET['id_b'];
        $reorder->hapusdatarop($id);
      }
    else if ($_GET['aksi'] == 'updaterop') {
        // proses update data biodata
        $lt = $_POST['leadtime'];
        $ss = $_POST['safetystock'];
        $rr = $_POST['ratarata'];
        $id_b = $_POST['id'];
        $reorder->updateropoint($lt,$ss,$rr,$id_b);
    }
    // proses edit data
    else if ($_GET['aksi'] == 'editrop') {
        // baca ID Biodata yang akan di edit
        $id = $_GET['id_b'];

      // menampilkan form edit Biodata pakai method bacaBiodata()
        ?>
        <br>
<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>?aksi=updaterop">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
<tr><td colspan=3><center><h3>MENGHITUNG REORDER POINT</h3></center></td></tr>
<tr><td>Lead Time (Lama Pemesanan)</td><td><input type=text name='leadtime'value="<?php echo $reorder->bacarop('leadtime', $id); ?>"> / Minggu</td>

<td rowspan=4>
<h3><center>HASIL<hr></center></h3>
<br>
<h3><center>

<?php echo $reorder->bacarop('reorderpoint', $id); ?>
</center></h3>
<br>
<h5><center>UNIT</center></h5>
</td></tr>

<tr><td>Safety Stock (Stok Cadangan Minimal)</td><td><input type=text name='safetystock' value="<?php echo $reorder->bacarop('safetystock', $id); ?>"></td></tr>
<tr><td>Rata-rata Pemakaian</td><td><input type=text name='ratarata' value="<?php echo $reorder->bacarop('averageusage', $id); ?>"> / Minggu</td></tr>
<tr><td></td>
  <td><button type='submit' class='btn btn-primary'>UPDATE</button></td>
</tr>
<input type="hidden" name="id" value="<?php echo $id; ?>">
</table>
</form>

        <?php
    }
    // hitung rop
    elseif ($_GET['aksi'] == 'hitungrop') {
        $lt = $_POST['leadtime'];
        $ss = $_POST['safetystock'];
        $rr = $_POST['ratarata'];
        $reorder->hitung($lt,$ss,$rr);

        //Tampil tabel data base reorder point
        $arraybiodata = $reorder->tampilrop();
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
      <tr><td colspan=8><center><h3>RECORD REORDER POINT</h3></center></td></tr>
      <tr><th>No.</th>
            <th>ID</th>
            <th>Lead Time @Minggu</th>
            <th>Safety Stock</th>
            <th>Pemakain Rata-rata @Minggu</th>
            <th>Reorder Point</th>
            <th>Tanggal dan Waktu</th>
            <th>Aksi</th>
       </tr>";
$i = 1;
foreach ($arraybiodata as $data) {
    echo "<tr><td>" . $i . "</td> 
              <td>" . $data['id_rop']  . "</td> 
              <td>" . $data['leadtime'] . "</td>
              <td>" . $data['safetystock'] . "</td>
              <td>" . $data['averageusage'] . "</td>
              <td>" . $data['reorderpoint'] . "</td>
              <td>" . $data['tanggal'] . "</td>
              <td><a class='btn btn-info btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=editrop&id_b=" . $data['id_rop'] . "'>Edit</a> 
                  <a class='btn btn-danger btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=hapusrop&id_b=" . $data['id_rop'] . "'>Hapus</a></td>
            </tr>";
    $i++;
}

echo "</table>";

    }
    // tampilkan view rop
    elseif ($_GET['aksi'] == 'tampilkanrop') {
        
        //Tampil tabel data base reorder point
        $arraybiodata = $reorder->tampilrop();
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
      <tr><td colspan=8><center><h3>RECORD REORDER POINT</h3></center></td></tr>
      <tr><th>No.</th>
            <th>ID</th>
            <th>Lead Time @Minggu</th>
            <th>Safety Stock</th>
            <th>Pemakain Rata-rata @Minggu</th>
            <th>Reorder Point</th>
            <th>Tanggal dan Waktu</th>
            <th>Aksi</th>
       </tr>";
$i = 1;
foreach ($arraybiodata as $data) {
    echo "<tr><td>" . $i . "</td> 
              <td>" . $data['id_rop']  . "</td> 
              <td>" . $data['leadtime'] . "</td>
              <td>" . $data['safetystock'] . "</td>
              <td>" . $data['averageusage'] . "</td>
              <td>" . $data['reorderpoint'] . "</td>
              <td>" . $data['tanggal'] . "</td>
              <td><a class='btn btn-info btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=editrop&id_b=" . $data['id_rop'] . "'>Edit</a> 
                  <a class='btn btn-danger btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=hapusrop&id_b=" . $data['id_rop'] . "'>Hapus</a></td>
            </tr>";
    $i++;
}

echo "</table>";

    }

    elseif ($_GET['aksi'] == 'hitung') {
echo"<br>
<form method=POST action='?aksi=hitungrop'>
<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
<tr><td colspan=3><center><h3>MENGHITUNG REORDER POINT</h3></center></td></tr>
<tr><td>Lead Time (Lama Pemesanan)</td><td><input type=text name='leadtime'> / Minggu</td>

<td rowspan=4>
<h3><center>HASIL<hr></center></h3>
<br>
<h3><center>";

echo "
</center></h3>
<br>
<h5><center>UNIT</center></h5>
</td></tr>

<tr><td>Safety Stock (Stok Cadangan Minimal)</td><td><input type=text name='safetystock'></td></tr>
<tr><td>Rata-rata Pemakaian</td><td><input type=text name='ratarata' > / Minggu</td></tr>
<tr><td></td><td><button type='submit' class='btn btn-primary'>Hitung</button></td></tr>

</table>
</form>
";

//Tampil tabel data base reorder point
        $arraybiodata = $reorder->tampilrop();
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
      <tr><td colspan=8><center><h3>RECORD REORDER POINT</h3></center></td></tr>
      <tr><th>No.</th>
            <th>ID</th>
            <th>Lead Time @Minggu</th>
            <th>Safety Stock</th>
            <th>Pemakain Rata-rata @Minggu</th>
            <th>Reorder Point</th>
            <th>Tanggal dan Waktu</th>
            <th>Aksi</th>
       </tr>";
$i = 1;
foreach ($arraybiodata as $data) {
    echo "<tr><td>" . $i . "</td> 
              <td>" . $data['id_rop']  . "</td> 
              <td>" . $data['leadtime'] . "</td>
              <td>" . $data['safetystock'] . "</td>
              <td>" . $data['averageusage'] . "</td>
              <td>" . $data['reorderpoint'] . "</td>
              <td>" . $data['tanggal'] . "</td>
              <td><a class='btn btn-info btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=editrop&id_b=" . $data['id_rop'] . "'>Edit</a> 
                  <a class='btn btn-danger btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=hapusrop&id_b=" . $data['id_rop'] . "'>Hapus</a></td>
            </tr>";
    $i++;
}

echo "</table>";

    }
//=======================================================
elseif ($_GET['aksi'] == 'tambahbahan') {
echo"<br>
<form method=POST action='?aksi=tmbhbahan'>
<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
<tr><td colspan=3><center><h3>INPUT DATA BAHAN</h3></center></td></tr>
<tr><td>Nama</td><td><input type=text name='namabahan'></td></tr>
<tr><td>Harga</td><td><input type=text name='hargabahan'></td></tr>
<tr><td>Biaya Pesan</td><td><input type=text name='biayapesan' ></td></tr>
<tr><td>Pemasok</td><td><input type=text name='pemasok' ></td></tr>
<tr><td>Stok</td><td><input type=text name='stok' ></td></tr>
<tr><td></td><td><button type='submit' class='btn btn-primary'>Simpan</button></td></tr>

</table>
</form>
";

//Tampil tabel data base reorder point
        $arraybiodata = $reorder->tampilbah();
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
      <tr><td colspan=9><center><h3>RECORD INPUT BAHAN</h3></center></td></tr>
      <tr><th>No.</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Biaya Pesan</th>
            <th>Pemasok</th>
            <th>Stok</th>
            <th>Tanggal Pesan</th>
            <th>Aksi</th>
       </tr>";
$i = 1;
foreach ($arraybiodata as $data) {
    echo "<tr><td>" . $i . "</td> 
              <td>" . $data['id_bah']  . "</td> 
              <td>" . $data['nama_bah'] . "</td>
              <td>" . $data['harga_bah'] . "</td>
              <td>" . $data['biaya_pesan_bah'] . "</td>
              <td>" . $data['pemasok_bah'] . "</td>
              <td>" . $data['stok_bah'] . "</td>
              <td>" . $data['tanggal_pesan'] . "</td>
              <td><a class='btn btn-info btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=editbah&id_b=" . $data['id_bah'] . "'>Edit</a> 
                  <a class='btn btn-danger btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=hapusbah&id_b=" . $data['id_bah'] . "'>Hapus</a></td>
            </tr>";
    $i++;
}

echo "</table>";
}
elseif ($_GET['aksi'] == 'tmbhbahan') {
        $nb = $_POST['namabahan'];
        $hb = $_POST['hargabahan'];
        $bp = $_POST['biayapesan'];
        $p = $_POST['pemasok'];
        $s = $_POST['stok'];
    
        $reorder->tambahkanbahan($nb,$hb,$bp,$p,$s);
    }
elseif ($_GET['aksi'] == 'hapusbah') {
        // baca ID dari parameter ID Biodata yang akan dihapus
        $id = $_GET['id_b'];
        $reorder->hapusdatabah($id);
      }

else if ($_GET['aksi'] == 'editbah') {
        // baca ID Biodata yang akan di edit
        $id = $_GET['id_b'];

// menampilkan form edit Biodata pakai method bacaBiodata()
        ?>  

        <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>?aksi=updatebah">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                <tr><td>Nama</td><td>:</td>
                    <td>
                      <input type="date" name="tanggal" value="<?php echo $db->bacaDataBiodata('tanggal_pro', $id); ?>">
                    </td>
                </tr>
        
        <tr><td>Harga</td><td>:</td>
                    <td><input type="text" name="jumlah" value="<?php echo $db->bacaDataBiodata('jumlah_pro', $id); ?>"></td>
                </tr>
        
        <tr><td>Biaya Pesan</td><td>:</td>
                    <td><input type="text" name="kodeproduk" value="<?php echo $db->bacaDataBiodata('kodeproduk_pro', $id); ?>"></td>
                </tr>
        
                <tr><td>Pemasok</td><td>:</td>
                    <td><input type="text" name="namaproduk" size="40" value="<?php echo $db->bacaDataBiodata('namaproduk_pro', $id); ?>"></td>
                </tr>
                <tr><td>Stok</td><td>:</td>
                    <td><input type="text" name="namaproduk" size="40" value="<?php echo $db->bacaDataBiodata('namaproduk_pro', $id); ?>"></td>
                </tr>
         
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <td><button type='submit' class='btn btn-primary'>UPDATE</button></td>
        </form>

        <?php
    }


//=======================================================
    
}

// buat array data biodata dari method tampilBiodata()
$arraybiodata = $db->tampilBiodata();

// echo"</table> <br> <a href='?aksi=tambah'><button type='submit' class='btn btn-primary'>TAMBAH</button></a>";
// echo" <a href='?aksi=hitung'><button type='submit' class='btn btn-primary'>Reorder Point</button></a>";
// echo" <a href='?aksi=tampilkanrop'><button type='submit' class='btn btn-primary'>View Reorder Point</button></a>";

echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
      <tr><td colspan=7><center><h3>PRODUKSI</h3></center></td></tr>
      <tr><th>No</th>
           <th>ID</th>
           <th>Tanggal</th>
		    <th>Jumlah</th>
			 <th>Kode Produk</th>
           <th>Nama Produk</th>
           <th>Aksi</th>
       </tr>";
$i = 1;
foreach ($arraybiodata as $data) {
    echo "<tr><td>" . $i . "</td> 
          	   <td>" . $data['id_pro'] . "</td>
			   <td>" . $data['tanggal_pro'] . "</td>
			   <td>" . $data['jumlah_pro'] . "</td>
               <td>" . $data['kodeproduk_pro'] . "</td>
               <td>" . $data['namaproduk_pro'] . "</td>
               <td><a class='btn btn-info btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=edit&id_b=" . $data['id_pro'] . "'>Edit</a> 
                   <a class='btn btn-danger btn-sm' href='" . $_SERVER['PHP_SELF'] . "?aksi=hapus&id_b=" . $data['id_pro'] . "'>Hapus</a></td>
            </tr>";
    $i++;
}

echo "</table>";
?>
</div>

	<div class="row-fluid">
			<div class="span12">
			  <div class="row-fluid">
				<div class="alert alert-info">
					<a name="contact"></a>
				  <h2>www.MahUINMaliki.com</h2>
				  <p class="text-info">Gudang Teknologi & Informasi</p>
				  <p>&copy; <a href="http://andeznet.com">www.MahUINMaliki.com</a>&nbsp<?php echo date("Y");?></p>
				</div><!--/span-->
			  </div><!--/row-->
			</div><!--/span-->
	</div><!--/row-->


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
</html>