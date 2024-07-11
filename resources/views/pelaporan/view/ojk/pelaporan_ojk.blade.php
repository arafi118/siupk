@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
<!-- <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9"> -->
        <tr>
            <td height="20" colspan="3" class="bottom">
                <!-- <?php
                $row = mysql_fetch_array(mysql_query("SELECT * FROM kabupaten k, kecamatan c, lkm l where k.id=c.kd_kab  AND c.id=l.lokasi AND l.lokasi='$lokasi'"));
                $alamat_lkm = $row['alamat'];
                $exp        = explode("#", $alamat_lkm);
                $alamat1    = $exp[0];
                $desa1      = $exp[1];
                $kodepos1   = $exp[2];
                $logo = $row['logo'];
                if (empty($logo)) {
                    echo "<img class='' alt='...' src='../../../images/upk.png' style='float:left; width:50; margin-right:5px;'>";
                } else {
                    echo "<img class='' alt='...' src='../../../images/logo/$logo' style='float:left; width:50; margin-right:5px;'>";
                }

                $ijin_usaha    = $row['ijin_usaha'];
                if (empty($ijin_usaha)) {
                    $ijin = "";
                } else {
                    $ijin = "Badan Hukum No.$ijin_usaha<br>";
                }

                echo "<div class='style9'>" . strtoupper("<b>$row[jenis_lkm] $row[nama_lkm_long]<br>KECAMATAN $row[nama_kec] KABUPATEN $row[nama_kab]</b>") . "<br>$ijin $alamat1 $desa1 $kodepos1 Telp. $row[telpon_kec] </div>";
                ?> -->
            </td>
            <td height="20" class="bottom">
                <div align="right" class="style9">Dok. Laporan <?php echo $laporan; ?><br>
                    Kd.Doc. NC.OJK-<?php echo $idf; ?></div>
            </td>
        </tr>
        <tr>
            <td align="center" height="30" colspan="4" class="style6 bottom">
                <br><?php echo strtoupper("$row[jenis_lkm] $row[nama_lkm_long]"); ?>
                <br>SANDI LKM <?php echo $row['sandi_lkm']; ?>
                <br>LAPORAN POSISI KEUANGAN
                <br>PER <?php echo strtoupper(tgl_indo($tgl_last)); ?></b>
            </td>
        </tr>
        <tr align="center" height="97%">
            <th width="6%" class="left bottom top">NO</th>
            <th width="50%" class="left bottom top">NAMA AKUN</th>
            <th width="15%%" class="left bottom top">KODE AKUN</th>
            <th width="25%" class="left right bottom top">JUMLAH</th>

        </tr>
        <?php
        for ($x = 1; $x <= 3; $x++) {
            switch ($x) {
                case "1":
                    ?>
                    <th class="left top bottom " height="100%" align="center"> A. </td>
                    <th class="left top bottom right" height="100%" colspan=3 align="left"> &nbsp; ASET</td>
                    <?php
                            break;
                        case "2":
                            ?>
                    <th class="left top bottom " height="100%" align="center"> B. </td>
                    <th class="left top bottom right" height="100%" colspan=3 align="left"> &nbsp; LIABILITAS</td>
                    <?php
                            break;
                        case "3":
                            ?>
                    <th class="left top bottom " height="100%" align="center"> C. </td>
                    <th class="left top bottom right" height="100%" colspan=3 align="left"> &nbsp; EKUITAS</td>
                        <?php
                                break;
                        }
                        $no = 0;
                            $view = mysql_query("select * from rekening_ojk_$_SESSION[lokasi] WHERE super_sub='$x' ORDER by urutan ASC, id ASC ");

                        $jaset = 0;
                        while ($rows = mysql_fetch_array($view)) {
                            if ($rows['sub'] == 0) {
                                $a = 0;
                                $no = $no + 1;
                        ?>
                            <tr>
                                <td class="left bottom" height="100%" align="left">&nbsp; <?php echo $no; ?></td>
                                <td class="left bottom" align="left"> &nbsp; <?php echo $rows['nama_akun']; ?></td>
                            <?php } else { ?>
                            <tr>
                                <td class="left bottom" height="100%" align="left">
                                    &nbsp; <?php echo $no; ?>.<?php $a = $a + 1; echo $a; ?>
                                </td>
                                <td class="left bottom" align="left"> &nbsp; <?php echo $rows['nama_akun']; ?></td>
                            <?php } ?>
                                <td class="left bottom" align="center"><?php echo $rows['kode']; ?></td>
                                <td class="left bottom right" align="right">
                                    <?php
                                        $subsaldo = 0;
                                        $categories = '';
                                        $reks = explode("#", $rows['rekening']);
    
                                        if ($reks[0] == "C") { /////////////////////            133
                                            $rsatu = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE  r.kd_rekening='215.01'"));
                                            $rdua = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE r.kd_rekening='215.02'"));
                                            $satu = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_kredit=r.kd_rekening AND t.rekening_kredit='215.01'"));
                                            $dua = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_debit=r.kd_rekening AND t.rekening_debit='215.02' "));
                                            $subsaldo = (($rsatu['jrl'] - $rdua['jrl']) + ($satu['jrl'] - $dua['jrl'])) * -1;
                                        } elseif ($reks[0] == "A") { /////////////////////////   140
                                            $raset = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jaset, r.kd_rekening AS kd_rekening from $table_rekening r WHERE r.kd_rekening='141.01' OR r.kd_rekening='151.01' OR r.kd_rekening='161.01'"));
                                            $aset = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jaset from $table_transaksi t, $table_rekening r WHERE $kondisi AND t.rekening_debit=r.kd_rekening AND (t.rekening_debit='141.01' OR t.rekening_debit='151.01' OR t.rekening_debit='161.01')"));
                                            $subsaldo = $aset['jaset'] + $raset['jaset'];
                                        } elseif ($reks[0] == "P") { /////////////////////       141
                                            $rsusut = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jsusut, r.kd_rekening AS kd_rekening from $table_rekening r WHERE r.kd_rekening='141.02' OR r.kd_rekening='151.02' OR r.kd_rekening='161.02' OR r.kd_rekening='141.03' OR r.kd_rekening='151.03' OR r.kd_rekening='161.03'"));
                                            $susut = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jsusut from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_kredit=r.kd_rekening AND (t.rekening_kredit='141.02' OR t.rekening_kredit='151.02' OR t.rekening_kredit='161.02' OR t.rekening_kredit='141.03' OR t.rekening_kredit='151.03' OR t.rekening_kredit='161.03')"));
                                            $subsaldo = ($rsusut['jsusut'] + $susut['jsusut']) * -1;
                                        } elseif ($reks[0] == "R") { /////////////////////       342
                                            $rempat = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE  SUBSTR(r.kd_rekening,1,1)='4'"));
                                            $rlima = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE SUBSTR(r.kd_rekening,1,1)='5'"));
                                            $empat = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_kredit=r.kd_rekening AND SUBSTR(t.rekening_kredit,1,1)='4'"));
                                            $lima = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_debit=r.kd_rekening AND SUBSTR(t.rekening_debit,1,1)='5' "));
                                            $subsaldo = (($rempat['jrl'] - $rlima['jrl']) + ($empat['jrl'] - $lima['jrl'])) * -1;
                                        } else {
                                            foreach ($reks as $rek) {
                                                $rek = trim($rek);
                                                $saldo = saldo("$tgl_kondisi-" . $rek);
                                                $subsaldo = $subsaldo + $saldo;
                                                // echo $rek;
                                                // echo "<br>";
                                            }
                                        }
    
                                        if (substr($rows['kode'], 0, 1) == 1 or substr($rows['kode'], 0, 1) == 4) {
                                            ///////////////////aktiva
    
                                            if ($subsaldo < 0) {
    
                                                echo "(" . number_format($subsaldo * -1) . ")";
                                            } else {
                                                echo number_format($subsaldo);
                                            }
                                        } else {
                                            ////////////////////////////////pasiva
    
                                            if ($subsaldo * -1 < 0) {
                                                echo "(" . number_format($subsaldo) . ")";
                                            } else {
    
                                                echo number_format($subsaldo * -1);
                                            }
                                        }
    
                                        $jaset = $jaset + $subsaldo;
    
                                        if ($x == 1) {
    
                                            $k = $k + $subsaldo;
                                        }
                                        if ($x == 2) {
    
                                            $l = $l + $subsaldo;
                                        }
                                        if ($x == 3) {
    
                                            $e = $e + $subsaldo;
                                        }
                                        if ($rows['kode'] == 110 or $rows['kode'] == 121 or $rows['kode'] == 122 or $rows['kode'] == 123) {
    
                                            $ks = $ks + $subsaldo;
                                        }
                                        if ($rows['kode'] == 210 or $rows['kode'] == 221 or $rows['kode'] == 222) {
    
                                            $ll = $ll + $subsaldo;
                                        }
    
                                        ?>
                                    </td>
                            </tr>
                        <?php
                            }
                            if ($x == 1) { ?>
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Aset</th>
                                    <?php
                                        if ($k < 0) { // jika aset negatif,, maka dalam kurung
                                    ?>
                                <th class="left top bottom right" align="right">(<?php echo number_format($k * -1); ?>)</th>
                                <?php } else { ?>
                                <th class="left top bottom right" align="right"><?php echo number_format($k); ?></th>
                                <?php } ?>
                            </tr>

                        <?php } elseif ($x == 2) { ?>
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Liabilitas</th>
                                    <?php
                                            if ($l < 0) { // jika Liabilitas positif,, maka dalam kurung
                                                ?>
                                <th class="left top bottom right" align="right"><?php echo number_format($l * -1); ?></th>
                                <?php } else { ?>
                                <th class="left top bottom right" align="right">(<?php echo number_format($l); ?>)</th>
                                <?php } ?>
                            </tr>
                            
                        <?php } 
                        elseif ($x == 3) { ?>
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Ekuitas</th>
                                    <?php
                                            if ($e < 0) { // jika Ekuitas positif,, maka dalam kurung
                                                ?>
                                <th class="left top bottom right" align="right"><?php echo number_format($e * -1); ?></th>
                                <?php } else { ?>
                                <th class="left top bottom right" align="right">(<?php echo number_format($e); ?>)</th>
                                <?php } ?>
                            </tr>
                    <?php }
                    }
                    ?>
                    <tr>
                        <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Liabilitas Dan Ekuitas</th>
                            <?php if ($l + $e < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                                ?>
                        <th class="left top bottom right" align="right"><?php echo number_format(($l + $e) * -1); ?></th>
                        <?php } else { ?>
                        <th class="left top bottom right" align="right">(<?php echo number_format(($l + $e)); ?>)</th>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th class="left top bottom " height="100%" align="center"> A. </th>
                        <th class="top left bottom" align="left"> &nbsp; Rasio Likuiditas</th>
                        <th class="top left bottom" align="right">&nbsp;</th>
                            <?php if ($ks / $ll < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                                ?>
                        <th class="top left bottom right" align="right"><?php echo number_format($ks / $ll * -1 * 100, 2) ?>%</th>
                        <?php } else { ?>
                        <th class="top left bottom right" align="right">(<?php echo number_format($ks / $ll * 100, 2) ?>%)</th>
                        <?php } ?>
                    </tr>

                    <tr>
                        <td class="left bottom" height="100%" align="left">&nbsp; 1.</td>
                        <td class="left bottom" align="left"> &nbsp; Kas dan Setara Kas</td>
                        <td class="left bottom" align="right">&nbsp;</td>
                        <?php if ($ks < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                            ?>
                            <td class="left bottom right" align="right">(<?php echo number_format($ks * -1) ?>)</td>
                        <?php } else { ?>
                            <td class="left bottom right" align="right"><?php echo number_format($ks) ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="left bottom" height="100%" align="left">&nbsp; 2.</td>
                        <td class="left bottom" align="left"> &nbsp; Liabilitas Lancar</td>
                        <td class="left bottom" align="right">&nbsp;</td>
                        <?php if ($ll < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                            ?>
                            <td class="left bottom right" align="right"><?php echo number_format($ll * -1) ?></td>
                        <?php } else { ?>
                            <td class="left bottom right" align="right">(<?php echo number_format($ll) ?>)</td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th class="left top bottom " height="100%" align="center"> B. </td>
                        <th class="top left bottom" align="left"> &nbsp; Rasio Solvabilitas</td>
                        <th class="top left bottom" align="right">&nbsp;</td>
                            <?php if ($k / $l < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                                ?>
                        <th class="top left bottom right" align="right"><?php echo number_format($k / $l * -1 * 100, 2) ?>%</td>
                        <?php } else { ?>
                        <th class="top left bottom right" align="right">(<?php echo number_format($k / $l * 100, 2) ?>%)</td>
                        <?php } ?>
                    </tr>

                    <ol type='a'>
                        <tr>
                            <td class="left bottom" height="100%" align="left">&nbsp; 1.</td>
                            <td class="left bottom" align="left"> &nbsp; Total Aset</li>
                            </td>
                    </ol>
                    <td class="left bottom" align="right">&nbsp;</td>
                    <?php
                    if ($k < 0) { // jika aset negatif,, maka dalam kurung
                        ?>
                        <td class="left bottom right" align="right">(<?php echo number_format($k * -1) ?>)</td>
                    <?php } else { ?>
                        <td class="left bottom right" align="right"><?php echo number_format($k) ?></td>
                    <?php } ?>
                    </tr>
                    <ol type='a'>
                        <tr>
                            <td class="left bottom" height="100%" align="left">&nbsp; 2.</td>
                            <td class="left bottom" align="left"> &nbsp; Total Liabilitas</li>
                            </td>
                    </ol>
                    <td class="left bottom" align="right">&nbsp;</td>
                    <?php
                    if ($l < 0) { // jika Liabilitas positif,, maka dalam kurung
                        ?>
                        <td class="left bottom right" align="right"><?php echo number_format($l * -1) ?></td>
                    <?php } else { ?>
                        <td class="left bottom right" align="right">(<?php echo number_format($l) ?>)</td>
                    <?php } ?>
                    </tr>


                    <tr>
                        <th class="top" height="100%" colspan=4 align="center">
                            <br><br><br></td>
                    </tr>

    </table>
@endsection
