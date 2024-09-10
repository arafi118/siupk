<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tanggal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        .form-container, .result-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 20px 0;
        }
        .result-container {
            width: 80%;
            max-width: 600px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        label {
            flex: 0 0 80px;
            margin-bottom: 0;
            margin-right: 10px;
            color: #666;
        }
        select, input[type="text"] {
            flex: 1;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        select {
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            background-size: 12px auto;
        }
        input[type="submit"], button {
            background-color: #5DC4BF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #47B3AE;
        }
        input[type="submit"]:disabled, button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .result-text {
            margin-bottom: 20px;
            color: #5DC4BF;  /* Warna hijau seperti tombol */
            font-weight: bold;
            font-size: 18px;
        }
        .result-text2 {
            margin-bottom: 20px;
            color: #333;
        }
        .result-text3 {
            margin-bottom: 20px;
            text-align: right;
            margin-top: -15px;
            color: #333;
            font-size:11px;
        }
        .process-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .process-form input[type="text"] {
            width: 70px;
            margin-right: 10px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #5DC4BF;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .back-button {
            background-color: #5DC4BF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #47B3AE;
        }
    </style>
</head>

<body>
    <?php
ini_set('display_errors', 1);//Atauerror_reporting(E_ALL && ~E_NOTICE);
$host = "localhost"; 
$user = "siupk_global"; 
$pass = "siupk_global"; 
$db = "siupk_dbm"; 

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);




    if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
    $bulan = $_GET['bulan'] ?? 0;
    $tahun = $_GET['tahun'] ?? 0; 
    $tahun_now = $_GET['tahun'] ?? 0;
        $bulan_lalu = $bulan - 1;
        // Jika $bulan adalah 1 (Januari), maka bulan lalu adalah Desember tahun sebelumnya
        if ($bulan_lalu == 0) {
            $bulan_lalu = 12;
            $bulan_lalu = 12;
            $tahun--;
        }
    $limit = $_GET['where'] ?? 0;
    $id = $_GET['id'] ?? 0;
    if($id == NULL or $id == ""){
        $where = 1;
    } else {
        // Memisahkan ID yang diinput menjadi array
        $id_array = explode(',', $id);
        // Membersihkan setiap ID dari spasi dan memastikan hanya angka
        $id_array = array_map('trim', $id_array);
        $id_array = array_filter($id_array, 'is_numeric');
        // Menggabungkan ID menjadi string untuk query
        $where = "id IN (" . implode(',', $id_array) . ")";
    }
    
            // Ambil URL saat ini
        $url = $_SERVER['HTTP_REFERER'] ?? 0; // atau bisa gunakan $_SERVER['REQUEST_URI'] untuk URL yang diminta saat ini.

        // Ambil hanya bagian host dari URL
        $web = parse_url($url, PHP_URL_HOST);

        // Query ke database
        $kec = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE web_kec='$web' OR web_alternatif='$web'"));
    $lokasi         = $kec['id'] ?? 0;
    $hitung_bunga   = $kec['hitung_bunga'] ?? 0;
    $min_bunga      = $kec['min_bunga'] ?? 0;
    $min_pajak      = $kec['min_pajak'] ?? 0;
    $tgl_bunga      = $kec['tgl_bunga'] ?? 0;
        
        if ($tgl_bunga == 0 OR $tgl_bunga == 1) {
            $tgl_awal   = sprintf("%04d-%02d-%02d", $tahun, $bulan_lalu, 1);
            $tgl_akhir  = date("Y-m-t", strtotime("$tahun-$bulan_lalu-01"));
            $tgl_trans  = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, 1);
        } else {
            $tgl_awal   = sprintf("%04d-%02d-%02d", $tahun, $bulan_lalu, $tgl_bunga);
            $bulan_depan= $bulan_lalu == 12 ? 1 : $bulan_lalu + 1;
            $tahun_depan= $bulan_lalu == 12 ? $tahun + 1 : $tahun;
            $tgl_akhir  = date("Y-m-d", strtotime(sprintf("%04d-%02d-%02d", $tahun_depan, $bulan_depan, $tgl_bunga) . " - 1 day"));
            $tgl_trans  = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, $tgl_bunga);
        }
        
    $jumlah_hari = (strtotime($tgl_akhir) - strtotime($tgl_awal)) / (60 * 60 * 24) + 1;
        
        
// Array untuk memetakan angka bulan ke nama bulan
$nama_bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
);

// Mendapatkan nama bulan berdasarkan nilai $bulan
$bulan_nama = $nama_bulan[$bulan];

        
    
    $q = mysqli_query($koneksi,"SELECT * FROM simpanan_anggota_$lokasi WHERE ($where) AND tgl_buka>=$tgl_awal ORDER BY id ASC");
    $total = mysqli_num_rows($q);
    
        echo "<div class='result-container'>";
        echo "<div class='result-text2'>Total Simpanan yang akan di proses adalah " . $total . " data.</div>";
        
        if (isset($_GET['limit']) && isset($_GET['start'])) {
            $start = $_GET['start'] + $_GET['limit'] ?? 0;
            $per_page = 25;
        } else {
            $start = 0;
            $per_page = 25;
        }
        
        ?>
    <form action="" method="get" class="process-form" id="runForm">
        <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
        <input type="hidden" name="where" value="<?php echo $limit; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="text" name="start" id="start" value="<?php echo $start; ?>" readonly>
        <input type="hidden" name="limit" id="limit" value="<?php echo $per_page; ?>" readonly>
        <button type="submit" name="migrate" id="runButton" <?php echo $start> $total ? 'disabled' : 'readonly'; ?>>Run</button>
    </form>
    <?php
    $q2 = mysqli_query($koneksi,"SELECT * FROM simpanan_anggota_$lokasi WHERE ($where) AND tgl_buka>=$tgl_awal ORDER BY id ASC  LIMIT $start, $per_page");
    $jbunga = 0;
    $jpajak = 0;
    $jadmin = 0;
        while ($simp = mysqli_fetch_array($q2)) {
            $a = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM anggota_$lokasi where id = '$simp[nia]'")); 
            $no_rek = $simp['nomor_rekening'] ?? 0;
            $nama_depan = $a['namadepan'] ?? 0;
            //data yang dibutuhkan
            $bunga = 0;
            $pajak = 0;
            $saldo = 0;
            $admin =  $simp['admin'] ?? 0;
            $pros_bunga = $simp['bunga']/100;
            $pros_pajak = $simp['pajak']/100;
            $jenis_simpanan = $simp['jenis_simpanan'] ?? 0;
                if($jenis_simpanan==1){ //di laravel bisa menggunakan tb jenis_simpanan
                    $rek_bunga = "221.02";
                    $rek_pajak = "221.05";
                    $rek_admin = "221.03";
                    
                    $pas_bunga = "515.01";
                    $pas_pajak = "231.01";
                    $pas_admin = "413.01";
                    $js = "SU";
                }elseif($jenis_simpanan==2){
                    $rek_bunga = "222.02";
                    $rek_pajak = "222.05";
                    $rek_admin = "222.03";
                    
                    $pas_bunga = "515.02";
                    $pas_pajak = "231.02";
                    $pas_admin = "413.02";
                    $js = "SD";
                }elseif($jenis_simpanan==3){
                    $rek_bunga = "223.02";
                    $rek_pajak = "223.05";
                    $rek_admin = "223.03";
                    
                    $pas_bunga = "515.03";
                    $pas_pajak = "231.03";
                    $pas_admin = "413.03";
                    $js = "SP";
                }else{
                    $rek_bunga = "221.02";
                    $rek_pajak = "221.05";
                    $rek_admin = "221.03";
                    
                    $pas_bunga = "515.01";
                    $pas_pajak = "231.01";
                    $pas_admin = "413.01";
                    $js = "SU";
                }
            
            //hitung saldo
            if($hitung_bunga==1){ //saldo_terakhir
                $real = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM real_simpanan_$lokasi WHERE cif=$simp[id] AND  tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tgl_transaksi DESC, id DESC LIMIT 1")); 
                $saldo = $real['sum'] ?? 0;
            }elseif($hitung_bunga==2){ //saldo_terendah
                $real = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM real_simpanan_$lokasi WHERE cif=$simp[id] AND  tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY sum ASC LIMIT 1")); 
                $saldo = $real['sum'] ?? 0;
            }else{ //saldo_rata2
                $re = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM real_simpanan_$lokasi WHERE cif=$simp[id] AND  tgl_transaksi < '$tgl_awal' ORDER BY tgl_transaksi DESC, id DESC LIMIT 1")); 
                $saldo_terakhir = $re['sum'] ?? 0;
                
                $r = (mysqli_query($koneksi,"SELECT * FROM real_simpanan_$lokasi WHERE cif=$simp[id] AND tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'")); 
                $jumdeb = 0;
                $jumkre = 0;
                    while($real = mysqli_fetch_array($r)){
                    $hari_ke = (strtotime($real['tgl_transaksi']) - strtotime($tgl_awal)) / (60 * 60 * 24) + 1;
                    $jumdeb  = $jumdeb+($real['real_d']*($jumlah_hari-($hari_ke+1)));
                    $jumkre  = $jumkre+($real['real_k']*($jumlah_hari-($hari_ke+1)));
                    }
                $saldo = ($saldo_terakhir*($jumlah_hari-1))+($jumdeb-$jumkre);
            }
            //hitung bunga dan pajak
            if($kec['min_bunga']<=$saldo){
                $bunga  = $saldo * $pros_bunga;
            }
            if($kec['min_pajak']<=$bunga){
                $pajak  = $bunga * $pros_bunga;
            }
            
            $jum_bunga = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM transaksi_$lokasi WHERE tgl_transaksi='$tgl_trans' AND rekening_kredit LIKE '22_.02' AND id_simp=$simp[id]"));
            $jum_pajak = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM transaksi_$lokasi WHERE tgl_transaksi='$tgl_trans' AND rekening_debit LIKE '22_.05' AND id_simp=$simp[id]"));
            $jum_admin = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM transaksi_$lokasi WHERE tgl_transaksi='$tgl_trans' AND rekening_debit LIKE '22_.03' AND id_simp=$simp[id]"));
            if($bunga>0 and $jum_bunga<1){
                $insert_bunga = mysqli_query($koneksi,"INSERT INTO `transaksi_$lokasi` 
                (`idt`, `tgl_transaksi`, `rekening_debit`, `rekening_kredit`, `idtp`, `id_pinj`, `id_pinj_i`, `id_simp`, `keterangan_transaksi`, `jumlah`, `urutan`, `id_user`) VALUES 
                (NULL, '$tgl_trans', '$pas_bunga', '$rek_bunga', '0', '0', '0', '$simp[id]', 'Bunga $js $no_rek $nama_depan $bulan_nama', '$bunga', '0', '1')");
                $jbunga = $jbunga +1;
            }
            
            if($pajak>0 and $jum_pajak<1){
                $insert_bunga = mysqli_query($koneksi,"INSERT INTO `transaksi_$lokasi` 
                (`idt`, `tgl_transaksi`, `rekening_debit`, `rekening_kredit`, `idtp`, `id_pinj`, `id_pinj_i`, `id_simp`, `keterangan_transaksi`, `jumlah`, `urutan`, `id_user`) VALUES 
                (NULL, '$tgl_trans', '$rek_pajak', '$pas_pajak', '0', '0', '0', '$simp[id]', 'Pajak $js $no_rek $nama_depan $bulan_nama', '$pajak', '0', '1')");
                $jpajak = $jpajak +1;
            }
            
            if($admin>0 and $jum_admin<1){
                $insert_bunga = mysqli_query($koneksi,"INSERT INTO `transaksi_$lokasi` 
                (`idt`, `tgl_transaksi`, `rekening_debit`, `rekening_kredit`, `idtp`, `id_pinj`, `id_pinj_i`, `id_simp`, `keterangan_transaksi`, `jumlah`, `urutan`, `id_user`) VALUES 
                (NULL, '$tgl_trans', '$rek_admin', '$pas_admin', '0', '0', '0', '$simp[id]', 'Admin $js $no_rek $nama_depan $bulan_nama', '$admin', '0', '1')");
                $jadmin = $jadmin +1;
            }
            $del_re = mysqli_query($koneksi,"DELETE FROM real_simpanan_$lokasi WHERE cif=$simp[id] AND tgl_transaksi>='$tgl_awal'");
            $query  = mysqli_query($koneksi,"SELECT * FROM transaksi_$lokasi WHERE id_simp=$simp[id] AND tgl_transaksi>='$tgl_awal' ORDER BY idt ASC");
                    $sum = 0;
                    while ($trx = mysqli_fetch_array($query)) {
                        $cif            = $simp['id'] ?? 0;
                        $tgl_transaksi  = $trx['tgl_transaksi'] ?? 0;
                        
                        if (substr($trx['rekening_kredit'], 0, 2) == '22') {
                            $real_d         = $trx['jumlah'] ?? 0;
                            $real_k         = 0;
                            $sum            = $sum + $real_d;
                        } elseif (substr($trx['rekening_debit'], 0, 2) == '22') {
                            $real_d         = 0;
                            $real_k         = $trx['jumlah'] ?? 0;
                            $sum            = $sum - $real_k;
                        } else {
                            // Jika tidak memenuhi kedua kondisi di atas, gunakan nilai default
                            $real_d         = $trx['jumlah'] ?? 0;
                            $real_k         = $trx['jumlah'] ?? 0;
                            // $sum tidak berubah dalam kasus ini
                        }
                        
                        $lu             = date('Y-m-d H:i:s');
                        $id_user        = $trx['id_user'] ?? 0;
                        
                        $insert_t = mysqli_query($koneksi,"INSERT INTO `real_simpanan_$lokasi`(`cif`, `tgl_transaksi`, `real_d`, `real_k`, `sum`, `lu`, `id_user`) 
                                     VALUES ('$cif','$tgl_transaksi','$real_d','$real_k','$sum','$lu','$id_user')");
                    }
        }
            
        if ($start > $total) {
            echo "<div class='result-text'>Proses simpan bunga bulan <span style='color: black;'>$bulan_nama</span> tahun <span style='color: black;'>$tahun</span> telah selesai.</div>
            <div class='result-text'> $jbunga bunga terinput, $jpajak pajak terinput, $jadmin admin terinput</div>";
        echo "<button onclick=\"window.location.href='?'\" class='back-button'>Back</button>";
        }
        echo "</div>";

        // Script untuk auto-run
        if ($start <= $total) {
            echo "
            <script>
            window.onload = function() {
                setTimeout(function() {
                    document.getElementById('runForm').submit();
                }, 1000); // Delay 1 detik sebelum submit
            }
            </script>
            ";
        }
    } else {
        ?>
    <div class="form-container">
        <h2>Pilih Bulan</h2>
        <form>
            <div class="form-group">
                <label for="bulan">Bulan</label>
                <select id="bulan" name="bulan" required>
                    <option value="">Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" name="tahun" required>
                    <option value="">Pilih Tahun</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id">CIF</label>
                <input type="text" id="id" name="id" placeholder="semua CIF">
            </div>
            <div class='result-text3'>jika hanya sebagian, ketiklah : <strong>CIF, CIF </strong>dst
            </div>
            <input type="submit" value="Kirim">
        </form>
    </div>
    <?php
    }
    ?>
</body>

</html>
