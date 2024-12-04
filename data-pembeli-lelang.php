<?php

$title = 'PT. GADAI SENYUM SUKACITA';
include 'layout/header.php';
include 'config/function.php';

$data_detail = select("SELECT pembeli_lelang.*, barang.rincian_barang 
                       FROM pembeli_lelang 
                       INNER JOIN barang ON pembeli_lelang.id_produk = barang.id_produk");

?>

<style type=text/css>
    body {
        background-color: #cc0;
    }
</style>

<div class="container mt-4">
    <h2>DATA PEMBELI LELANG</h2>
    <table class="table table-hover" id="tabel-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Barang Lelang</th>
                <th>PEMBELI</th>
                <th>No HP</th>
            </tr>  
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach($data_detail as $detail)  : ?>

            <tr></tr>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $detail['rincian_barang']; ?></td>
                <td><?= $detail['nama']; ?></td>
                <td><?= $detail['no_hp']; ?></td>
            
            </tr>
            <?php //endforeach; ?>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php

include 'layout/footer.php'

?>

