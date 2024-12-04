<?php

$title = 'PT. GADAI SENYUM SUKACITA';
include 'layout/header.php';
include 'config/function.php';
$data_barang = select("
    SELECT * 
    FROM transaksi AS t 
    INNER JOIN barang AS k ON t.id_produk = k.id_produk 
    WHERE k.label_barang = 'Lelang' 
    AND k.id_produk NOT IN (SELECT id_produk FROM pembeli_lelang)
");
?>

<style type=text/css>
    body {
        background-color: #cc0;
    }
</style>

<div class="container mt-4">
    <h2>LELANG</h2>

<table class="table table-hover" id="tabel-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga Lelang</th>
                <?php if (isset($_SESSION['status_login'])) : ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>  
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach($data_barang as $barang) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $barang['rincian_barang']; ?></td>
                <td>Rp <?= number_format($barang['taksiran'], 0, ',', '.'); ?></td>
                <?php if (isset($_SESSION['status_login'])) : ?>
                <td>
                    <a href="form-pembeli-lelang.php?id_produk=<?= $barang['id_produk'];?>" class="btn btn-warning">
                        <i class='fa fa-shopping-cart'></i> Beli
                    </a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
</div>

<?php

include 'layout/footer.php'

?>
