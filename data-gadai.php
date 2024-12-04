<?php

$title = 'PT. GADAI SENYUM SUKACITA';
include 'layout/header.php';
include 'config/function.php';

// Menjalankan query untuk mengambil data gadai
$data_barang = select("
    SELECT 
        t.no_kwitansi, 
        t.jlh_pinjaman, 
        t.tgl_jatuh_tempo, 
        t.id_produk, 
        b.rincian_barang, 
        d.nama AS nama_karyawan, 
        p.nama AS nama_penggadai 
    FROM 
        transaksi AS t
    INNER JOIN 
        barang AS b ON t.id_produk = b.id_produk
    INNER JOIN 
        penggadai AS p ON t.id_produk = p.id_produk
    INNER JOIN 
        karyawan AS k ON t.id_pegawai = k.id_pegawai
    INNER JOIN 
        detail_data_karyawan AS d ON k.nik = d.nik
    WHERE 
        b.label_barang = 'Gadai';
");


?>

<style type=text/css>
    body {
        background-color: #cc0;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    table {
        white-space: nowrap;
        /* Mencegah teks dalam kolom terpotong */
    }
</style>

<div class="container-fluid mt-4" style="margin: 0 1 rem;">
<h2 style="text-align: center;">DATA PEGADAIAN</h2>
        <div>
            <a href="form-barang.php">
                <button type="button" class="btn btn-dark mt-2 mb-4"
                    style="float: left; font-family: 'Quicksand';">Formulir Persetujuan Nasabah</button>
            </a>
            <br><br><br>
        </div>
    <div class="table-responsive">
        <table class="table table-hover" id="tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Nama Penggadai</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Nama Karyawan</th>
                    <th>Aksi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_barang as $barang) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td style="white-space: normal"><?= $barang['rincian_barang']; ?></td>
                        <td><?= $barang['nama_penggadai']; ?></td>
                        <td><?= formatDate($barang['tgl_jatuh_tempo']); ?></td>
                        <td><?= $barang['nama_karyawan']; ?></td>
                        <td>
                            <a href="detail-data.php?id_produk=<?= $barang['id_produk']; ?>" class="btn btn-dark">
                                Detail
                            </a>
                            <a href="ubah-data.php?id_produk=<?= $barang['id_produk']; ?>" class="btn btn-success">
                                Ubah
                            </a>
                        </td>
                        <td>
                            <a href="ubah-barang.php?id_produk=<?= $barang['id_produk']; ?>" class="btn btn-primary">
                                <i class="fa-solid fa-bank"></i> Lelang
                            </a>

                            <a href="hapus-data.php?id_produk=<?= $barang['id_produk']; ?>" class="btn btn-danger"
                                onclick="return confirm('Apakah ingin menghapus data ini?');">
                                <i class="fa-solid fa-trash"></i> Lunas
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>