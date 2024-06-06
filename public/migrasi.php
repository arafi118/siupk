<?php
ini_set('display_errors', '1');
session_start();
$koneksi = mysqli_connect('cpanel.siupk.net', 'siupk_global', 'siupk_global', 'siupk_dbm');
$trigger = mysqli_connect('cpanel.siupk.net', 'siupk_global', 'siupk_global', 'siupk_perantara');

$MigrasiLokasi = '';
if (isset($_GET['lokasi'])) {
    $MigrasiLokasi = $_GET['lokasi'];
}
if (isset($_POST['copy'])) {
    $lokasi = htmlspecialchars($_POST['lokasi']);

    $kec = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siupk_perantara.kecamatan WHERE id='$lokasi'"));

    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.anggota_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.inventaris_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.kelompok_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.pinjaman_anggota_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.pinjaman_kelompok_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.real_angsuran_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.real_angsuran_i_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.rekening_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.rencana_angsuran_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.rencana_angsuran_i_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.transaksi_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.saldo_" . $lokasi);
    mysqli_query($koneksi, "DROP TABLE IF EXISTS siupk_dbm.ebudgeting_" . $lokasi);

    mysqli_query($koneksi, "DELETE FROM siupk_dbm.users WHERE lokasi='$lokasi'");
    mysqli_query($koneksi, "DELETE FROM siupk_dbm.kecamatan WHERE id='$lokasi'");
    mysqli_query($koneksi, "DELETE FROM siupk_dbm.desa WHERE kd_kec='$kec[kd_kec]'");

    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.anggota_$lokasi LIKE siupk_perantara.anggota_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.inventaris_$lokasi LIKE siupk_perantara.inventaris_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.kelompok_$lokasi LIKE siupk_perantara.kelompok_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.pinjaman_anggota_$lokasi LIKE siupk_perantara.pinjaman_anggota_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.pinjaman_kelompok_$lokasi LIKE siupk_perantara.pinjaman_kelompok_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.real_angsuran_$lokasi LIKE siupk_perantara.real_angsuran_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.real_angsuran_i_$lokasi LIKE siupk_perantara.real_angsuran_i_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.rekening_$lokasi LIKE siupk_perantara.rekening_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.rencana_angsuran_$lokasi LIKE siupk_perantara.rencana_angsuran_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.rencana_angsuran_i_$lokasi LIKE siupk_perantara.rencana_angsuran_i_$lokasi");
    mysqli_query($koneksi, "CREATE TABLE siupk_dbm.transaksi_$lokasi LIKE siupk_perantara.transaksi_$lokasi");

    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS siupk_dbm.saldo_$lokasi LIKE siupk_dbm.saldo");
    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS siupk_dbm.ebudgeting_$lokasi LIKE siupk_dbm.ebudgeting");

    mysqli_query($koneksi, "INSERT siupk_dbm.anggota_$lokasi SELECT * FROM siupk_perantara.anggota_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.inventaris_$lokasi SELECT * FROM siupk_perantara.inventaris_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.kelompok_$lokasi SELECT * FROM siupk_perantara.kelompok_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.pinjaman_anggota_$lokasi SELECT * FROM siupk_perantara.pinjaman_anggota_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.pinjaman_kelompok_$lokasi SELECT * FROM siupk_perantara.pinjaman_kelompok_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.real_angsuran_$lokasi SELECT * FROM siupk_perantara.real_angsuran_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.real_angsuran_i_$lokasi SELECT * FROM siupk_perantara.real_angsuran_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.rekening_$lokasi SELECT * FROM siupk_perantara.rekening_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.rencana_angsuran_$lokasi SELECT * FROM siupk_perantara.rencana_angsuran_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.rencana_angsuran_i_$lokasi SELECT * FROM siupk_perantara.rencana_angsuran_$lokasi");
    mysqli_query($koneksi, "INSERT siupk_dbm.transaksi_$lokasi SELECT * FROM siupk_perantara.transaksi_$lokasi");

    mysqli_query($koneksi, "INSERT INTO siupk_dbm.users SELECT * FROM siupk_perantara.users WHERE lokasi='$lokasi'");
    mysqli_query($koneksi, "INSERT INTO siupk_dbm.kecamatan SELECT * FROM siupk_perantara.kecamatan WHERE id='$lokasi'");
    mysqli_query($koneksi, "INSERT INTO siupk_dbm.desa SELECT * FROM siupk_perantara.desa WHERE kd_kec='$kec[kd_kec]'");

    mysqli_query($koneksi, "ALTER TABLE siupk_dbm.anggota_$lokasi CHANGE `usaha` `usaha` VARCHAR(50) NULL DEFAULT '0'");
    mysqli_query($koneksi, "ALTER TABLE siupk_dbm.rekening_$lokasi ADD `parent_id` VARCHAR(50) NULL FIRST");
    mysqli_query($koneksi, "ALTER TABLE siupk_dbm.pinjaman_anggota_$lokasi CHANGE `kom_pokok` `kom_pokok` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `kom_jasa` `kom_jasa` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL");
    mysqli_query($koneksi, "UPDATE siupk_dbm.rekening_$lokasi SET parent_id=CONCAT(lev1, lev2, lev3) WHERE 1");

    $calk = '{"peraturan_desa":"","D":{"1":{"d":{"1":0,"2":0,"3":0}},"2":{"a":0,"b":0,"c":0}}}';
    mysqli_query($koneksi, "UPDATE siupk_dbm.kecamatan SET calk='$calk' WHERE id='$lokasi'");

    $query = mysqli_query($koneksi, "SELECT * FROM siupk_dbm.tanda_tangan_laporan WHERE lokasi='$lokasi'");
    if (mysqli_num_rows($query) <= 0) {
        $ttd_pelaporan = '"<table class=\"p0\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-size: 11px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 33.3333%;\">&nbsp;<\/td>\r\n<td style=\"width: 33.3333%;\">&nbsp;<\/td>\r\n<td style=\"width: 33.3333%;\">&nbsp;<\/td>\r\n<\/tr>\r\n<\/tbody>\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center;\">Diperiksa Oleh<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">Dilaporkan<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\"><strong>......................................<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>......................................<\/strong><\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\"><strong>Badan Pengawas<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>Bendahara<\/strong><\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">Disetujui Oleh<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>......................................<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>Direktur<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<\/tbody>\r\n<\/table>"';
        $ttd_spk = '"<table class=\"p0\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-size: 12px;\"><tr><td style=\"width: 33.4186%;\">&nbsp;<\/td><td style=\"width: 33.4186%;\">&nbsp;<\/td><td style=\"width: 16.6545%;\">&nbsp;<\/td><td style=\"width: 16.5449%;\">&nbsp;<\/td><\/tr>\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center;\">Pihak Pertama<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\" colspan=\"2\">Pihak Kedua<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\" colspan=\"4\">\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\"><strong>{kepala_lembaga}<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>{ketua}<\/strong><\/td>\r\n<td style=\"text-align: center;\"><strong>{sekretaris}<\/strong><\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\"><strong>Direktur<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>Ketua<\/strong><\/td>\r\n<td style=\"text-align: center;\"><strong>Sekretaris<\/strong><\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">Mengetahui<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">{sebutan_kades} {desa}<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\" colspan=\"4\">\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<p>&nbsp;<\/p>\r\n<\/td>\r\n<\/tr>\r\n<tr>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\"><strong>{kades}<\/strong><\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<td style=\"text-align: center;\">&nbsp;<\/td>\r\n<\/tr>\r\n<\/tbody>\r\n<\/table>"';

        mysqli_query($koneksi, "INSERT INTO siupk_dbm.tanda_tangan_laporan (`id`, `lokasi`, `tanda_tangan_pelaporan`, `tanda_tangan_spk`) VALUES (NULL, '$lokasi', '$ttd_pelaporan', '$ttd_spk')");
    }

    $create = "
    CREATE TRIGGER `create_saldo_debit_$lokasi` AFTER INSERT ON `transaksi_$lokasi`
        FOR EACH ROW BEGIN
            INSERT INTO saldo_$lokasi (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (CONCAT(REPLACE(NEW.rekening_debit, '.',''), YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0')), NEW.rekening_debit, YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0'), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi))) ON DUPLICATE KEY UPDATE 
                debit= (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)),
                kredit=(SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi));

            INSERT INTO saldo_$lokasi (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (CONCAT(REPLACE(NEW.rekening_kredit, '.',''), YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0')), NEW.rekening_kredit, YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0'), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi))) ON DUPLICATE KEY UPDATE 
                debit= (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)),
                kredit=(SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi));

        END;
    ";

    $update = "
    CREATE TRIGGER `update_saldo_debit_$lokasi` AFTER UPDATE ON `transaksi_$lokasi`
        FOR EACH ROW BEGIN

            INSERT INTO saldo_$lokasi (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (CONCAT(REPLACE(NEW.rekening_debit, '.',''), YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0')), NEW.rekening_debit, YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0'), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi))) ON DUPLICATE KEY UPDATE 
                debit= (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)),
                kredit=(SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi));

            INSERT INTO saldo_$lokasi (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (CONCAT(REPLACE(NEW.rekening_kredit, '.',''), YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0')), NEW.rekening_kredit, YEAR(NEW.tgl_transaksi), LPAD(MONTH(NEW.tgl_transaksi), 2, '0'), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi))) ON DUPLICATE KEY UPDATE 
                debit= (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi)),
                kredit=(SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=NEW.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(NEW.tgl_transaksi),'-01-01') AND LAST_DAY(NEW.tgl_transaksi));

        END;
    ";

    $delete = "
    CREATE TRIGGER `delete_saldo_debit_$lokasi` AFTER DELETE ON `transaksi_$lokasi`
        FOR EACH ROW BEGIN

            INSERT INTO saldo_$lokasi (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (CONCAT(REPLACE(OLD.rekening_debit, '.',''), YEAR(OLD.tgl_transaksi), LPAD(MONTH(OLD.tgl_transaksi), 2, '0')), OLD.rekening_debit, YEAR(OLD.tgl_transaksi), MONTH(OLD.tgl_transaksi), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=OLD.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi)), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=OLD.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi))) ON DUPLICATE KEY UPDATE 
                debit= (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=OLD.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi)),
                kredit=(SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=OLD.rekening_debit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi));

            INSERT INTO saldo_$lokasi (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (CONCAT(REPLACE(OLD.rekening_kredit, '.',''), YEAR(OLD.tgl_transaksi), LPAD(MONTH(OLD.tgl_transaksi), 2, '0')), OLD.rekening_kredit, YEAR(OLD.tgl_transaksi), MONTH(OLD.tgl_transaksi), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=OLD.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi)), (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=OLD.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi))) ON DUPLICATE KEY UPDATE 
                debit= (SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_debit=OLD.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi)),
                kredit=(SELECT SUM(jumlah) FROM transaksi_$lokasi WHERE rekening_kredit=OLD.rekening_kredit AND tgl_transaksi BETWEEN CONCAT(YEAR(OLD.tgl_transaksi),'-01-01') AND LAST_DAY(OLD.tgl_transaksi));

        END;
    ";

    mysqli_query($koneksi, $create);
    mysqli_query($koneksi, $update);
    mysqli_query($koneksi, $delete);

    mysqli_query($koneksi, "UPDATE siupk_dbm.inventaris_$lokasi SET kategori='1', jenis='1' WHERE kategori='1' AND jenis='3'");
    mysqli_query($koneksi, "UPDATE siupk_dbm.inventaris_$lokasi SET kategori='1', jenis='3' WHERE kategori='5' AND jenis='2'");
    mysqli_query($koneksi, "UPDATE siupk_dbm.inventaris_$lokasi SET kategori='2', jenis='3' WHERE kategori='6' AND jenis='2'");
    mysqli_query($koneksi, "UPDATE siupk_dbm.inventaris_$lokasi SET kategori='3', jenis='3' WHERE kategori='7' AND jenis='2'");

    $_SESSION['success'] = "Copy Tabel Lokasi <b>$lokasi</b> Berhasil.";
    echo "<script>location.href = '/migrasi.php';</script>";
} else {
?>

    <?php
    if (isset($_SESSION['success'])) {
        echo "<div>$_SESSION[success]</div>";

        unset($_SESSION['success']);
    }
    ?>

    <form action="" method="post">
        <input type="text" name="lokasi" id="lokasi" value="<?= $MigrasiLokasi; ?>">
        <button type="submit" name="copy" id="copy">Copy Tabel</button>
    </form>

<?php } ?>