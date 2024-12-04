<?php
$title = 'Formulir Persetujuan Nasabah';
include 'layout/header.php';
include 'config/function.php';

$nik = $_SESSION['nik'];

// Query untuk mendapatkan id_pegawai dari tabel karyawan berdasarkan nik
$query_karyawan = "SELECT id_pegawai FROM karyawan WHERE nik = '$nik'";
$result_karyawan = mysqli_query($db, $query_karyawan);

if ($result_karyawan && mysqli_num_rows($result_karyawan) > 0) {
    $data_karyawan = mysqli_fetch_assoc($result_karyawan);
    $id_pegawai = $data_karyawan['id_pegawai'];

    // Query untuk mendapatkan nama pegawai dari tabel detail_data_karyawan
    $query_detail = "SELECT nama FROM detail_data_karyawan WHERE nik = '$nik'";
    $result_detail = mysqli_query($db, $query_detail);
    if ($result_detail && mysqli_num_rows($result_detail) > 0) {
        $pegawai = mysqli_fetch_assoc($result_detail);
    } else {
        // Jika nama pegawai tidak ditemukan
        $pegawai['nama'] = 'Nama Pegawai Tidak Ditemukan';
    }
} else {
    // Jika id_pegawai tidak ditemukan, tampilkan pesan error
    echo "<script>alert('ID Pegawai tidak ditemukan!'); document.location.href = 'login.php';</script>";
    exit;
}

if (isset($_POST['tambah'])) {
    mysqli_begin_transaction($db);

    if (create_barang($_POST) > 0) {
        $id_produk = mysqli_insert_id($db);
        $_POST['id_produk'] = $id_produk;

        if (create_penggadai($_POST) > 0) {
            create_transaksi($_POST);
            mysqli_commit($db);
            echo "
            <script>
            alert('Penggadaian berhasil! ');
            document.location.href = 'data-gadai.php';
            </script>";
        } else {
            mysqli_rollback($db);
            $error_message = 'Data penggadai gagal ditambah!';
        }
    } else {
        mysqli_rollback($db);
        $error_message = 'Data barang gagal ditambah!';
    }
}

?>



<style type=text/css>
    body {
        background-color: #cc0;
    }

    .kotak {
        display: flex;
        margin: 15px
    }

    .row {
        margin: 0 10px;
    }
</style>

<div>
    <h3 class="text-center" style="margin-top: 30px">Formulir Persetujuan Nasabah</h3>
    <div style=" padding: 2.5rem; margin: 0 3.5rem; background-color: #def880;">
        <form action="" method="post">
            <div class="kotak">
                <div class="row" style="align-content:flex-start; ">
                    <div class="mb-3">
                        <label for="rincian_barang" class="form-label">Rincian Barang Jaminan</label>
                        <textarea class="form-control"
                            style="min-height: 127px" id="rincian_barang" name="rincian_barang" rows="2"
                            placeholder="Tertera merk, tipe, serta kondisi" required></textarea>
                    </div>
                    <div style="display: flex; justify-content: space-between">
                        <div class="mb-3">
                            <label for="jenis_barang" class="form-label">Jenis Barang</label>
                            <select class="form-select" id="jenis_barang" name="jenis_barang" required>
                                <option selected value="">::Pilih Jenis Barang::</option>
                                <option value="Kendaraan">Kendaraan</option>
                                <option value="Elektronik">Elektronik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="label_barang" class="form-label">Jenis Transaksi</label>
                            <select class="form-select" id="label_barang" name="label_barang" required>
                                <option selected value="">::Pilih Tipe Transaksi::</option>
                                <option value="Gadai">Gadai</option>
                                <option value="Lelang">Lelang</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="taksiran">Taksiran Harga</label>
                        <input type="text" class="form-control" id="taksiran" name="taksiran"
                            placeholder="Taksiran Harga Barang yang digadai" required>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap </label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="NAMA PENGGADAI" required>
                        </div>

                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK PENGGADAI" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP Aktif (No WA)</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                placeholder="contoh: 081xxxxxxxxx" required>
                        </div>

                    </div>
                </div>
            </div>
            <div style="margin: 0 2.5rem">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" style="min-height: 127px" id="alamat" name="alamat" rows="2" placeholder="ALAMAT" required></textarea>
                </div>
            </div>

            <div>
                <div style="display: flex;">
                    <div class="container">
                        <div class="row">
                            <div class="mb-3">
                                <label for="jlh_pinjaman" class="form-label">Jumlah Pinjaman</label>
                                <input type="text" class="form-control" id="jlh_pinjaman" name="jlh_pinjaman"
                                    placeholder="Jumlah pinjaman yang diajukan" required>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                <input class="form-control" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" type="date" required>
                            </div>
                        </div>


                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="mb-3">
                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                <input class="form-control" name="nama_pegawai" placeholder="<?= isset($pegawai['nama']) ? $pegawai['nama'] : 'Nama Pegawai Tidak Ditemukan'; ?>" value="<?= isset($pegawai['nama']) ? $pegawai['nama'] : ''; ?>" disabled>
                                <input type="hidden" name="id_pegawai" value="<?= isset($id_pegawai) ? $id_pegawai : ''; ?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div style="margin: 0 2.5rem">
                <button type="submit" name="tambah" class="btn btn-primary mt-4"
                    style="float: left; font-family: 'Quicksand'; color: white">
                    Tambah
                </button>

                <a href="javascript:window.history.go(-1);" class="btn btn-dark mt-4" style="margin-left: 4pt">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>


<?php

include 'layout/footer.php';

?>