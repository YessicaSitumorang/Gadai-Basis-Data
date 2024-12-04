<?php

$title = 'Formulir Pembelian Lelang';
include 'layout/header.php';
include 'config/function.php';

//cek apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_pembelilelang($_POST) > 0) {
      echo "<script>
              alert('Pembelian berhasil! Menunggu konfirmasi');
              document.location.href = 'data-lelang.php';
             </script>";
    }
  
    else {
      echo "<script>
              alert('Pembelian barang gagal!');
              document.location.href = 'form-lelang.php';
             </script>";
    }
}

?>

<style type=text/css>
    body {
        background-color: #cc0;
    }
</style>

<div class="container mt-4">
    <h3 style="text-align: center;">Formulir Pembelian Barang</h3>

    <form action="" method="post">
    <div class="row mt-4" style="border: 1px solid grey; margin: 0 30%">
        <div class="col-sm mt-3" style="padding: 30px 50px">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap </label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="NAMA PEMBELI" required>
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK PEMBELI"  required>
            </div>
            
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP Aktif (No WA)</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" 
                placeholder="contoh: 081xxxxxxxxx"  required>
            </div>

            <div class="mb-3">
                <label for="id_produk" class="form-label">ID Barang</label>
                <select class="form-select" id="id_produk" name="id_produk"  " required>
                    <option selected value="">::Pilih Barang::</option>
                <?php
                include "koneksi.php";
                $query = mysqli_query($db,"SELECT * FROM barang WHERE label_barang='Lelang'") or die (mysqli_error($db));
                while($data = mysqli_fetch_array($query)){
                    echo "<option value=$data[id_produk]> $data[rincian_barang] </option>";
                }
                ?>
                </select>
            </div>

        </div>
  </div>

  <div style=" margin: 0 30%">
    <button type="submit" name="tambah" class="btn btn-primary mt-4" 
    style="float: left; font-family: 'Quicksand'; color: white" href="transaksi.php?id_produk=<?= $penggadai['id_produk'];?>">
       Tambah
    </button>

    <a href="javascript:window.history.go(-1);" class="btn btn-dark mt-4" style="margin-left: 4pt">
       Kembali
    </a>
    </div>


  </form>

</div>


<?php

include 'layout/footer.php';

?>