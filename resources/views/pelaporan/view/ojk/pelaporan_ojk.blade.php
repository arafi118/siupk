

<style type="text/css">
    .style6 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 16px;
    }

    .style9 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    .style10 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
    }

    .top {
        border-top: 1px solid #000000;
    }

    .bottom {
        border-bottom: 1px solid #000000;
    }

    .left {
        border-left: 1px solid #000000;
    }

    .right {
        border-right: 1px solid #000000;
    }

    .all {
        border: 1px solid #000000;
    }

    .style26 {
        font-family: Verdana, Arial, Helvetica, sans-serif
    }

    .style27 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
    }

    .align-justify {
        text-align: justify;
    }

    .align-center {
        text-align: center;
    }

    .align-right {
        text-align: right;
    }

    .pull-right {
        float: right;
        margin-left: 120px;
    }
</style>


    <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
        <tr>
            <td height="20" colspan="3" class="bottom">
               @php
                @if (empty($logo)) {
                    echo "<img class='' alt='...' src='../../../images/upk.png' style='float:left; width:50; margin-right:5px;'>";
                } 
                @else {
                    echo "<img class='' alt='...' src='../../../images/logo/$logo' style='float:left; width:50; margin-right:5px;'>";
                }

                <!-- $ijin_usaha    = $row['ijin_usaha']; -->
                @if (empty($ijin_usaha)) {
                    $ijin = "";
                } 
                @else {
                    <!-- $ijin = "Badan Hukum No.$ijin_usaha<br>"; -->
                }

               @endphp
            </td>
            <td height="20" class="bottom">
                <div align="right" class="style9">Dok. Laporan ----<br>
                    Kd.Doc. NC.OJK-----</div>
            </td>
        </tr>
        <tr>
            <td align="center" height="30" colspan="4" class="style6 bottom">
                <br>----
                <br>SANDI LKM ----
                <br>LAPORAN POSISI KEUANGAN
                <br>PER----</b>
            </td>
        </tr>
        <tr align="center" height="97%">
            <th width="6%" class="left bottom top">NO</th>
            <th width="50%" class="left bottom top">NAMA AKUN</th>
            <th width="15%%" class="left bottom top">KODE AKUN</th>
            <th width="25%" class="left right bottom top">JUMLAH</th>

        </tr>
                    <th class="left top bottom " height="100%" align="center"> A. </td>
                    <th class="left top bottom right" height="100%" colspan=3 align="left"> &nbsp; ASET</td>
                    <th class="left top bottom " height="100%" align="center"> B. </td>
                    <th class="left top bottom right" height="100%" colspan=3 align="left"> &nbsp; LIABILITAS</td>
                 
                    <th class="left top bottom " height="100%" align="center"> C. </td>
                    <th class="left top bottom right" height="100%" colspan=3 align="left"> &nbsp; EKUITAS</td>
                        @php
                                break;
                        
                        $no = 0;
                            <!-- $view = mysql_query("select * from rekening_ojk_$_SESSION[lokasi] WHERE super_sub='$x' ORDER by urutan ASC, id ASC ");

                        $jaset = 0;
                        while ($rows = mysql_fetch_array($view)) { -->
                            @if ($rows['sub'] == 0) {
                                $a = 0;
                                $no = $no + 1;
                        @endphp
                            <tr>
                                <td class="left bottom" height="100%" align="left">&nbsp;----</td>
                                <td class="left bottom" align="left"> &nbsp; ----</td>
                            @?php } 
                            else { 
                                @endphp
                            <tr>
                                <td class="left bottom" height="100%" align="left">
                                    &nbsp; ----.----
                                </td>
                                <td class="left bottom" align="left"> &nbsp; ----</td>
                            @php } 
                            @endphp
                                <td class="left bottom" align="center">---</td>
                                <td class="left bottom right" align="right">
                                   @php
                                        $subsaldo = 0;
                                        $categories = '';
                                        $reks = explode("#", $rows['rekening']);
    
                                        @if ($reks[0] == "C") { /////////////////////            133
                                            $rsatu = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE  r.kd_rekening='215.01'"));
                                            $rdua = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE r.kd_rekening='215.02'"));
                                            $satu = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_kredit=r.kd_rekening AND t.rekening_kredit='215.01'"));
                                            $dua = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_debit=r.kd_rekening AND t.rekening_debit='215.02' "));
                                            $subsaldo = (($rsatu['jrl'] - $rdua['jrl']) + ($satu['jrl'] - $dua['jrl'])) * -1;
                                        } @elseif ($reks[0] == "A") { /////////////////////////   140
                                            $raset = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jaset, r.kd_rekening AS kd_rekening from $table_rekening r WHERE r.kd_rekening='141.01' OR r.kd_rekening='151.01' OR r.kd_rekening='161.01'"));
                                            $aset = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jaset from $table_transaksi t, $table_rekening r WHERE $kondisi AND t.rekening_debit=r.kd_rekening AND (t.rekening_debit='141.01' OR t.rekening_debit='151.01' OR t.rekening_debit='161.01')"));
                                            $subsaldo = $aset['jaset'] + $raset['jaset'];
                                        } @elseif ($reks[0] == "P") { /////////////////////       141
                                            $rsusut = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jsusut, r.kd_rekening AS kd_rekening from $table_rekening r WHERE r.kd_rekening='141.02' OR r.kd_rekening='151.02' OR r.kd_rekening='161.02' OR r.kd_rekening='141.03' OR r.kd_rekening='151.03' OR r.kd_rekening='161.03'"));
                                            $susut = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jsusut from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_kredit=r.kd_rekening AND (t.rekening_kredit='141.02' OR t.rekening_kredit='151.02' OR t.rekening_kredit='161.02' OR t.rekening_kredit='141.03' OR t.rekening_kredit='151.03' OR t.rekening_kredit='161.03')"));
                                            $subsaldo = ($rsusut['jsusut'] + $susut['jsusut']) * -1;
                                        } @elseif ($reks[0] == "R") { /////////////////////       342
                                            $rempat = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE  SUBSTR(r.kd_rekening,1,1)='4'"));
                                            $rlima = mysql_fetch_array(mysql_query("select sum(r.$tb) AS jrl, r.kd_rekening AS kd_rekening from $table_rekening r WHERE SUBSTR(r.kd_rekening,1,1)='5'"));
                                            $empat = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_kredit=r.kd_rekening AND SUBSTR(t.rekening_kredit,1,1)='4'"));
                                            $lima = mysql_fetch_array(mysql_query("select (sum(jumlah)) AS jrl from $table_transaksi t, $table_rekening r  WHERE $kondisi AND t.rekening_debit=r.kd_rekening AND SUBSTR(t.rekening_debit,1,1)='5' "));
                                            $subsaldo = (($rempat['jrl'] - $rlima['jrl']) + ($empat['jrl'] - $lima['jrl'])) * -1;
                                        } @else {
                                            foreach ($reks as $rek) {
                                                $rek = trim($rek);
                                                $saldo = saldo("$tgl_kondisi-" . $rek);
                                                $subsaldo = $subsaldo + $saldo;
                                                // echo $rek;
                                                // echo "<br>";
                                            }
                                        }
    
                                       @if (substr($rows['kode'], 0, 1) == 1 or substr($rows['kode'], 0, 1) == 4) {
                                            ///////////////////aktiva
    
                                            @if ($subsaldo < 0) {
    
                                                echo "(" . number_format($subsaldo * -1) . ")";
                                            } @else {
                                                echo number_format($subsaldo);
                                            }
                                        } @else {
                                            ////////////////////////////////pasiva
    
                                            @if ($subsaldo * -1 < 0) {
                                                echo "(" . number_format($subsaldo) . ")";
                                            } @else {
    
                                                echo number_format($subsaldo * -1);
                                            }
                                        }
    
                                        $jaset = $jaset + $subsaldo;
    
                                        @if ($x == 1) {
    
                                            $k = $k + $subsaldo;
                                        }
                                        @if ($x == 2) {
    
                                            $l = $l + $subsaldo;
                                        }
                                        @if ($x == 3) {
    
                                            $e = $e + $subsaldo;
                                        }
                                        @if ($rows['kode'] == 110 or $rows['kode'] == 121 or $rows['kode'] == 122 or $rows['kode'] == 123) {
    
                                            $ks = $ks + $subsaldo;
                                        }
                                        @if ($rows['kode'] == 210 or $rows['kode'] == 221 or $rows['kode'] == 222) {
    
                                            $ll = $ll + $subsaldo;
                                        }
    
                                        @endphp
                                    </td>
                            </tr>
                        @php
                            }
                            @if ($x == 1) { ?>
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Aset</th>
                                    <?php
                                        @if ($k < 0) { // jika aset negatif,, maka dalam kurung
                                    ?>
                                <th class="left top bottom right" align="right">----</th>
                                @php } @else { 2endphp
                                <th class="left top bottom right" align="right">---</th>
                                @php } @endphp
                            </tr>

                        @php } @elseif ($x == 2) { @endphp
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Liabilitas</th>
                                    <?php
                                            @if ($l < 0) { // jika Liabilitas positif,, maka dalam kurung
                                                ?>
                                <th class="left top bottom right" align="right">---</th>
                                @php } @else { @endphp
                                <th class="left top bottom right" align="right">----</th>
                            @php } @endphp
                            </tr>
                            
                        @php } 
                        @elseif ($x == 3) { ?>
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Ekuitas</th>
                                    <?php
                                            @if ($e < 0) { // jika Ekuitas positif,, maka dalam kurung
                                                ?>
                                <th class="left top bottom right" align="right">----</th>
                                @php } @else { @endphp
                                <th class="left top bottom right" align="right">----</th>
                                @php } @endphp
                            </tr>
                    @php }
                    
                    @endphp
                    <tr>
                        <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Liabilitas Dan Ekuitas</th>
                            @php @if ($l + $e < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                               @endphp
                        <th class="left top bottom right" align="right">----</th>
                        @php } @else { ?>
                        <th class="left top bottom right" align="right">----</th>
                        @php } @endphp
                    </tr>

                    <tr>
                        <th class="left top bottom " height="100%" align="center"> A. </th>
                        <th class="top left bottom" align="left"> &nbsp; Rasio Likuiditas</th>
                        <th class="top left bottom" align="right">&nbsp;</th>
                            @php 
                            @if ($ks / $ll < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                                @endphp
                        <th class="top left bottom right" align="right">----%</th>
                        @php } @else { @endphp
                        <th class="top left bottom right" align="right">---</th>
                        @php } @endphp
                    </tr>

                    <tr>
                        <td class="left bottom" height="100%" align="left">&nbsp; 1.</td>
                        <td class="left bottom" align="left"> &nbsp; Kas dan Setara Kas</td>
                        <td class="left bottom" align="right">&nbsp;</td>
                        @php @if ($ks < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                            @endphp
                            <td class="left bottom right" align="right">----</td>
                        @php } @else { ?>
                            <td class="left bottom right" align="right">----</td>
                        @php } @endphp
                    </tr>
                    <tr>
                        <td class="left bottom" height="100%" align="left">&nbsp; 2.</td>
                        <td class="left bottom" align="left"> &nbsp; Liabilitas Lancar</td>
                        <td class="left bottom" align="right">&nbsp;</td>
                        @php @if ($ll < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                            @endphp
                            <td class="left bottom right" align="right">----</td>
                        @php } @else { @endphp
                            <td class="left bottom right" align="right">----</td>
                        @php } @endphp                    </tr>

                    <tr>
                        <th class="left top bottom " height="100%" align="center"> B. </td>
                        <th class="top left bottom" align="left"> &nbsp; Rasio Solvabilitas</td>
                        <th class="top left bottom" align="right">&nbsp;</td>
                            @php @if ($k / $l < 0) { // jika Liabilitas Dan Ekuitas positif,, maka dalam kurung
                                @endphp
                        <th class="top left bottom right" align="right">----%</td>
                        @php } @else { @endphp
                        <th class="top left bottom right" align="right">----</td>
                        @php } @endphp
                    </tr>

                    <ol type='a'>
                        <tr>
                            <td class="left bottom" height="100%" align="left">&nbsp; 1.</td>
                            <td class="left bottom" align="left"> &nbsp; Total Aset</li>
                            </td>
                    </ol>
                    <td class="left bottom" align="right">&nbsp;</td>
                    @php
                    @if ($k < 0) { // jika aset negatif,, maka dalam kurung
                        @endphp
                        <td class="left bottom right" align="right">----</td>
                    @php } @else { @endphp
                        <td class="left bottom right" align="right">---</td>
                    @php } @endphp
                    </tr>
                    <ol type='a'>
                        <tr>
                            <td class="left bottom" height="100%" align="left">&nbsp; 2.</td>
                            <td class="left bottom" align="left"> &nbsp; Total Liabilitas</li>
                            </td>
                    </ol>
                    <td class="left bottom" align="right">&nbsp;</td>
                    @php
                    @f ($l < 0) { // jika Liabilitas positif,, maka dalam kurung
                        @endphp
                        <td class="left bottom right" align="right">---</td>
                    @php } @else { @endphp
                        <td class="left bottom right" align="right">----</td>
                    @php } @endphp
                    </tr>


                    <tr>
                        <th class="top" height="100%" colspan=4 align="center">
                            <br><br><br></td>
                    </tr>

    </table>

   