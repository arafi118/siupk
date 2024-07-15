@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
 <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9"> 
        <tr>
            <td height="20" colspan="3" class="bottom">
            </td>
            <td height="20" class="bottom">
                <div align="right" class="style9">Dok. Laporan ----<br>
                    Kd.Doc. NC.OJK-------</div>
            </td>
        </tr>
        <tr>
            <td align="center" height="30" colspan="4" class="style6 bottom">
                <br>-----
                <br>SANDI LKM -----
                <br>LAPORAN POSISI KEUANGAN
                <br>PER -----</b>
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
                      
                            <tr>
                                <td class="left bottom" height="100%" align="left">&nbsp;-----</td>
                                <td class="left bottom" align="left"> &nbsp; -----</td>
                            <tr>
                                <td class="left bottom" height="100%" align="left">
                                    &nbsp; -----
                                </td>
                                <td class="left bottom" align="left"> &nbsp; -----</td>
                                <td class="left bottom" align="center">-----</td>
                                <td class="left bottom right" align="right">
                                   
                                    </td>
                            </tr>
                      
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Aset</th>
                                   
                                <th class="left top bottom right" align="right">-----</th>
                                <th class="left top bottom right" align="right">-----</th>
                            </tr>

                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Liabilitas</th>
                                  
                                <th class="left top bottom right" align="right">-----</th>
                              
                                <th class="left top bottom right" align="right">-----</th>
                            </tr>
                            
                     
                            <tr>
                                <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Ekuitas</th>
                                  
                                <th class="left top bottom right" align="right">-----</th>
                                <th class="left top bottom right" align="right">-----</th>
                            </tr>
                   
                   
                    <tr>
                        <th class="left top bottom" height="100%" colspan=3 align="center">Jumlah Liabilitas Dan Ekuitas</th>
                            
                        <th class="left top bottom right" align="right">-----</th>
                        <th class="left top bottom right" align="right">-----</th>
                    
                    </tr>

                    <tr>
                        <th class="left top bottom " height="100%" align="center"> A. </th>
                        <th class="top left bottom" align="left"> &nbsp; Rasio Likuiditas</th>
                        <th class="top left bottom" align="right">&nbsp;</th>
                                
                        <th class="top left bottom right" align="right">-----%</th>
                        <th class="top left bottom right" align="right">----</th>
                      
                    </tr>

                    <tr>
                        <td class="left bottom" height="100%" align="left">&nbsp; 1.</td>
                        <td class="left bottom" align="left"> &nbsp; Kas dan Setara Kas</td>
                        <td class="left bottom" align="right">&nbsp;</td>
                            <td class="left bottom right" align="right">-----</td>
                            <td class="left bottom right" align="right">-----</td>
                    </tr>
                    <tr>
                        <td class="left bottom" height="100%" align="left">&nbsp; 2.</td>
                        <td class="left bottom" align="left"> &nbsp; Liabilitas Lancar</td>
                        <td class="left bottom" align="right">&nbsp;</td>
                            <td class="left bottom right" align="right">-----</td>
                      
                            <td class="left bottom right" align="right">-----</td>
                    
                    </tr>

                    <tr>
                        <th class="left top bottom " height="100%" align="center"> B. </td>
                        <th class="top left bottom" align="left"> &nbsp; Rasio Solvabilitas</td>
                        <th class="top left bottom" align="right">&nbsp;</td>
                              
                        <th class="top left bottom right" align="right">-----%</td>
                        <th class="top left bottom right" align="right"><-----/td>
                    </tr>

                    <ol type='a'>
                        <tr>
                            <td class="left bottom" height="100%" align="left">&nbsp; 1.</td>
                            <td class="left bottom" align="left"> &nbsp; Total Aset</li>
                            </td>
                    </ol>
                    <td class="left bottom" align="right">&nbsp;</td>
                   
                        <td class="left bottom right" align="right">-----</td>
                        <td class="left bottom right" align="right">-----</td>
                 
                    </tr>
                    <ol type='a'>
                        <tr>
                            <td class="left bottom" height="100%" align="left">&nbsp; 2.</td>
                            <td class="left bottom" align="left"> &nbsp; Total Liabilitas</li>
                            </td>
                    </ol>
                    <td class="left bottom" align="right">&nbsp;</td>
                   
                        <td class="left bottom right" align="right">-----</td>
                    
                        <td class="left bottom right" align="right">-----</td>
                 
                    </tr>


                    <tr>
                        <th class="top" height="100%" colspan=4 align="center">
                            <br><br><br></td>
                    </tr>

    </table>
@endsection
