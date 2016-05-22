<?php
//membuat class databse
class database {
    // properti
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "crud_oop";

    // method koneksi MySQL
    function connectMySQL() {
        mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
        mysql_select_db($this->dbName) or die("Database tidak ada!");
    }

    // method tambah data (insert)	
    function tambahBiodata($tgl,$jml,$kp,$np) {
	
        $query = "INSERT INTO biodata(tanggal_pro,jumlah_pro,kodeproduk_pro,namaproduk_pro) VALUES ('$tgl','$jml','$kp','$np')";
        $hasil = mysql_query($query);

        if ($hasil)
		  echo "<div class='alert alert-block alert-success'><strong><i></i> DATA BERHASIL DI SIMPAN</strong></div>";

        else
            echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>";
		}
	

    // method tampil data 	
    function tampilBiodata() {
        $query = mysql_query("SELECT * FROM biodata ORDER BY id_pro");
        while ($row = mysql_fetch_array($query))
            $data[] = $row;
        return $data;
    }

    // method hapus data
    function hapusBiodata($id_b) {
        $query = mysql_query("DELETE FROM biodata WHERE id_pro='$id_b'");
		if ($query)
		    echo "<div class='alert alert-block alert-success'><strong><i></i> Data Biodata dengan ID " . $id_b . " sudah dihapus</strong></div>";
		else
			 echo "<div class='alert alert-block alert-danger'><strong><i></i>GAGAL DI HAPUS</strong></div>";
    }

    // method membaca data biodata
    function bacaDataBiodata($field, $id_b) {
        $query = "SELECT * FROM biodata WHERE id_pro = '$id_b'";
        $hasil = mysql_query($query);
        $data = mysql_fetch_array($hasil);
        if ($field == 'tanggal_pro')
            return $data['tanggal_pro'];
		else if ($field == 'jumlah_pro')
            return $data['jumlah_pro'];
		else if ($field == 'kodeproduk_pro')
            return $data['kodeproduk_pro'];
        else if ($field == 'namaproduk_pro')
            return $data['namaproduk_pro'];
    }

    // method untuk proses update data biodata
    function updateDataBiodata($id_b,$tgl,$jml,$kp,$np) {
        $query = "UPDATE biodata SET tanggal_pro='$tgl',jumlah_pro='$jml',kodeproduk_pro='$kp', namaproduk_pro ='$np' WHERE id_pro='$id_b'";
        $hasilupdate=mysql_query($query);
		
        if ($hasilupdate)
		    echo "<div class='alert alert-block alert-success'><strong><i></i> DATA BERHASIL DI UPDATE</strong></div>";
        else
            echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>e";
    }

}
//===================================================
class rop{
    function bacarop($field, $id_b) {
        $query = "SELECT * FROM reorderpoint WHERE id_rop = '$id_b'";
        $hasil = mysql_query($query);
        $data = mysql_fetch_array($hasil);
        if ($field == 'leadtime')
            return $data['leadtime'];
        else if ($field == 'safetystock')
            return $data['safetystock'];
        else if ($field == 'averageusage')
            return $data['averageusage'];
        else if ($field == 'reorderpoint')
            return $data['reorderpoint'];
    }
    function tampilrop() {
        $query = mysql_query("SELECT * FROM reorderpoint ORDER BY id_rop");
        while ($row = mysql_fetch_array($query))
            $data[] = $row;
        return $data;

    }
    function hapusdatarop($id_b) {
        $query = mysql_query("DELETE FROM reorderpoint WHERE id_rop='$id_b'");
        //Tampil tabel data base reorder point
        $arraybiodata = $this->tampilrop();
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
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

        if ($query)
            echo "<div class='alert alert-block alert-success'><strong><i></i> Data Biodata dengan ID " . $id_b . " sudah dihapus</strong></div>";
        else
             echo "<div class='alert alert-block alert-danger'><strong><i></i>GAGAL DI HAPUS</strong></div>";
    }

    function updateropoint($lt,$ss,$rr,$id_b){
        $hasil = ($lt*$rr)+($ss*$rr);
        // return $hasil;
echo"<br>
<form method=POST action='?aksi=hitungrop'>
<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
<tr><td colspan=3><center><h3>MENGHITUNG REORDER POINT</h3></center></td></tr>
<tr><td>Lead Time (Lama Pemesanan)</td><td><input type=text name='leadtime'> / Minggu</td>

<td rowspan=4>
<h3><center>HASIL<hr></center></h3>
<br>
<h3><center>";
echo $hasil;
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
        $query = "UPDATE reorderpoint SET leadtime='$lt',safetystock='$ss',averageusage='$rr', reorderpoint ='$hasil' WHERE id_rop='$id_b'";
        $hasilupdate=mysql_query($query);
        
        if ($hasilupdate)
            echo "<div class='alert alert-block alert-success'><strong><i></i> DATA BERHASIL DI UPDATE</strong></div>";
        else
            echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>e";

        $arraybiodata = $this->tampilrop();
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
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


    }

    function hitung($lt,$ss,$rr){
        $hasil = ($lt*$rr)+($ss*$rr);
        // return $hasil;
echo"<br>
<form method=POST action='?aksi=hitungrop'>
<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >
<tr><td colspan=3><center><h3>MENGHITUNG REORDER POINT</h3></center></td></tr>
<tr><td>Lead Time (Lama Pemesanan)</td><td><input type=text name='leadtime'> / Minggu</td>

<td rowspan=4>
<h3><center>HASIL<hr></center></h3>
<br>
<h3><center>";
echo $hasil;
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
        $query = "INSERT INTO reorderpoint(leadtime,safetystock,averageusage,reorderpoint) VALUES ('$lt','$ss','$rr','$hasil')";
        $hasilsql = mysql_query($query);

        if ($hasilsql)
          echo "<div class='alert alert-block alert-success'><strong><i></i> DATA BERHASIL DI SIMPAN</strong></div>";

        else
         echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>";

    }
    function tampilbah() {
        $query = mysql_query("SELECT * FROM bahan_baku ORDER BY id_bah");
        while ($row = mysql_fetch_array($query))
            $data[] = $row;
        return $data;
    }
    function tambahkanbahan($nb,$hb,$bp,$p,$s) {
    
        $query = "INSERT INTO bahan_baku(nama_bah,harga_bah,biaya_pesan_bah,pemasok_bah,stok_bah) VALUES ('$nb','$hb','$bp','$p','$s')";
        $hasil = mysql_query($query);

        $arraybiodata = $this->tampilbah();
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

        if ($hasil)
          echo "<div class='alert alert-block alert-success'><strong><i></i> DATA BERHASIL DI SIMPAN</strong></div>";

        else
            echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>";
        }
    function hapusdatabah($id) {
        $query = mysql_query("DELETE FROM bahan_baku WHERE id_bah='$id'");
        //Tampil tabel data base reorder point
        $arraybiodata = $this->tampilbah();
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

        if ($query)
            echo "<div class='alert alert-block alert-success'><strong><i></i> Data Biodata dengan ID " . $id . " sudah dihapus</strong></div>";
        else
             echo "<div class='alert alert-block alert-danger'><strong><i></i>GAGAL DI HAPUS</strong></div>";
    }
    // method untuk proses update data biodata
    function updatebah($id_b,$tgl,$jml,$kp,$np) {
        $query = "UPDATE biodata SET tanggal_pro='$tgl',jumlah_pro='$jml',kodeproduk_pro='$kp', namaproduk_pro ='$np' WHERE id_pro='$id_b'";
        $hasilupdate=mysql_query($query);
        
        if ($hasilupdate)
            echo "<div class='alert alert-block alert-success'><strong><i></i> DATA BERHASIL DI UPDATE</strong></div>";
        else
            echo "<div class='alert alert-block alert-danger'><strong><i></i> DATA GAGAL DI UPDATE</strong></div>e";
    }


    
}
?>
