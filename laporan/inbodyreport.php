<?php
include_once 'query.php';
$q = new Query();

//ndapetin nama proyek
$id = $_POST['id_proyek'];
$temp = mysql_query("select * from proyek where id_proyek='$id'");
$nm = mysql_fetch_array($temp);

?>

<?php
//BUAT TENAGA KERJA
$rx = $q->getReportTenagaKerja($_POST['id_proyek'], $_POST['bulan'] . '-' . $_POST['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kerja[$rowx['nama_progres_tenaga_kerja']] = $rowx;
}

//BUAT KEGIATAN
$rx = $q->getReportKegiatan($_POST['id_proyek'], $_POST['bulan'] . '-' . $_POST['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kegiatan[$rowx['nama_progres_kegiatan']] = $rowx;
}

//BUAT KECELAKAAN
$rx = $q->getReportKecelakaan($_POST['id_proyek'], $_POST['bulan'] . '-' . $_POST['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kecelakaan[$rowx['nama_laporan_kecelakaan']] = $rowx;
}

//BUAT KONDISI
$rx = $q->getReportKondisi($_POST['id_proyek'], $_POST['bulan'] . '-' . $_POST['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kondisi[$rowx['nama_kondisi']] = $rowx;
}

//print_r($kondisi);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr></tr>
<tr>
  <td colspan="14" align="center" style="border:solid 1px">Laporan Bulanan</td>
</tr>
<tr>
  <td colspan="2" style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="4">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="2" style="border-left:solid 1px">No</td>
  <td width="84">&nbsp;</td>
  <td width="7%">&nbsp;</td>
  <td width="7%">&nbsp;</td>
  <td width="7%">&nbsp;</td>
  <td colspan="4">Laporan Bulan</td>
  <td width="9%" align="center">:</td>
  <td colspan="2"><?php echo $nama_bulan[$_POST['bulan']].' '.$_POST['tahun'];  ?></td>
  <td width="7%" style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="2" style="border-left:solid 1px">Proyek</td>
  <td><?php echo $nm['NAMA_PROYEK']; ?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="4">Laporan Ke</td>
  <td align="center">:</td>
  <td colspan="2">&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td width="3%" style="border-left:solid 1px">&nbsp;</td>
  <td width="5%">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td width="13%">&nbsp;</td>
  <td width="4%">&nbsp;</td>
  <td width="7%">&nbsp;</td>
  <td width="6%">&nbsp;</td>
  <td>&nbsp;</td>
  <td width="3%">&nbsp;</td>
  <td width="7%">&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="14" style="border-right:solid 1px; border-left:solid 1px">A. Kegiatan Safety</td>
</tr>
<tr>
  <td style="border-left:solid 1px; border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="center">s/d bln    lalu</td>
  <td align="center">bln ini</td>
  <td align="center">s/d bln ini</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2">s/d    bln lalu</td>
  <td>bln ini</td>
  <td style="border-right:solid 1px">s/d bln ini</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td width="5%" align="center">A1</td>
  <td width="84">Safety Talk</td>
  <td><?php if (isset($kegiatan['safety talk']))
    echo $kegiatan['safety talk']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['safety talk']))
    echo $kegiatan['safety talk']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['safety talk']))
    echo $kegiatan['safety talk']['jumlah_total']; else
    echo 0; ?></td>
  <td>&nbsp;</td>
  <td width="4%">A5</td>
  <td colspan="2">Laporan</td>
  <td colspan="2"><?php if (isset($kegiatan['laporan']))
    echo $kegiatan['laporan']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['laporan']))
    echo $kegiatan['laporan']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td style="border-right:solid 1px"><?php if (isset($kegiatan['laporan']))
    echo $kegiatan['laporan']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td align="center">A2</td>
  <td>Inspeksi K3</td>
  <td><?php if (isset($kegiatan['inspeksi k3']))
    echo $kegiatan['inspeksi k3']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['inspeksi k3']))
    echo $kegiatan['inspeksi k3']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['inspeksi k3']))
    echo $kegiatan['inspeksi k3']['jumlah_total']; else
    echo 0; ?></td>
  <td>&nbsp;</td>
  <td>A6</td>
  <td colspan="2">SIP</td>
  <td colspan="2"><?php if (isset($kegiatan['SIP']))
    echo $kegiatan['SIP']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['SIP']))
    echo $kegiatan['SIP']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td style="border-right:solid 1px"><?php if (isset($kegiatan['SIP']))
    echo $kegiatan['SIP']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td align="center">A3</td>
  <td>Safety Patrol</td>
  <td><?php if (isset($kegiatan['safety patrol']))
    echo $kegiatan['safety patrol']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['safety patrol']))
    echo $kegiatan['safety patrol']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['safety patrol']))
    echo $kegiatan['safety patrol']['jumlah_total']; else
    echo 0; ?></td>
  <td>&nbsp;</td>
  <td>A7</td>
  <td colspan="2">SIB</td>
  <td colspan="2"><?php if (isset($kegiatan['SIB']))
    echo $kegiatan['SIB']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['SIB']))
    echo $kegiatan['SIB']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td style="border-right:solid 1px"><?php if (isset($kegiatan['SIB']))
    echo $kegiatan['SIB']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td align="center">A4</td>
  <td>Safety Meeting</td>
  <td><?php if (isset($kegiatan['safety meeting']))
    echo $kegiatan['safety meeting']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['safety meeting']))
    echo $kegiatan['safety meeting']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['safety meeting']))
    echo $kegiatan['safety meeting']['jumlah_total']; else
    echo 0; ?></td>
  <td>&nbsp;</td>
  <td>A8</td>
  <td colspan="2">Pelatihan</td>
  <td colspan="2"><?php if (isset($kegiatan['pelatihan']))
    echo $kegiatan['pelatihan']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td><?php if (isset($kegiatan['pelatihan']))
    echo $kegiatan['pelatihan']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td style="border-right:solid 1px"><?php if (isset($kegiatan['pelatihan']))
    echo $kegiatan['pelatihan']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="14" style="border-right:solid 1px; border-left:solid 1px">B. Jumlah tenaga kerja dan jam kerja</td>
</tr>
<tr>
  <td style="border-left:solid 1px; border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2">s/d    bln lalu</td>
  <td></td>
  <td>bln ini</td>
  <td></td>
  <td colspan="2" style="border-right:solid 1px">s/d bln ini</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td width="5%">B1</td>
  <td colspan="3">Jumlah hari kerja (akumulatif) </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2"><?php if (isset($kerja['jumlah hari kerja']))
    echo $kerja['jumlah hari kerja']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td width="6%" align="center">+</td>
  <td width="9%"><?php if (isset($kerja['jumlah hari kerja']))
    echo $kerja['jumlah hari kerja']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td width="3%" align="center">=</td>
  <td colspan="2" style="border-right:solid 1px"><?php if (isset($kerja['jumlah hari kerja']))
    echo $kerja['jumlah hari kerja']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>B2</td>
  <td colspan="3">jumlah jam kerja (akumulatif) </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2"><?php if (isset($kerja['jumlah jam kerja']))
    echo $kerja['jumlah jam kerja']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td align="center">+</td>
  <td><?php if (isset($kerja['jumlah jam kerja']))
    echo $kerja['jumlah jam kerja']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td align="center">=</td>
  <td colspan="2" style="border-right:solid 1px"><?php if (isset($kerja['jumlah jam kerja']))
    echo $kerja['jumlah jam kerja']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>B3</td>
  <td colspan="3">jumlah tenaga kerja (akumulatif) </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2"><?php if (isset($kerja['jumlah tenaga kerja']))
    echo $kerja['jumlah tenaga kerja']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td align="center">+</td>
  <td><?php if (isset($kerja['jumlah tenaga kerja']))
    echo $kerja['jumlah tenaga kerja']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td align="center">=</td>
  <td colspan="2" style="border-right:solid 1px"><?php if (isset($kerja['jumlah tenaga kerja']))
    echo $kerja['jumlah tenaga kerja']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>B4</td>
  <td colspan="3">jumlah kehilangan jam kerja (akumulatif) </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2"><?php if (isset($kerja['jumlah kehilangan jam kerja']))
    echo $kerja['jumlah kehilangan jam kerja']['jumlah_bulan_lalu']; else
    echo 0; ?></td>
  <td align="center">+</td>
  <td><?php if (isset($kerja['jumlah kehilangan jam kerja']))
    echo $kerja['jumlah kehilangan jam kerja']['jumlah_bulan_ini']; else
    echo 0; ?></td>
  <td align="center">=</td>
  <td colspan="2" style="border-right:solid 1px"><?php if (isset($kerja['jumlah kehilangan jam kerja']))
    echo $kerja['jumlah kehilangan jam kerja']['jumlah_total']; else
    echo 0; ?></td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="14" style="border-right:solid 1px; border-left:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="6">&nbsp;</td>
  <td colspan="2">s/d bln    lalu</td>
  <td colspan="2">bln ini</td>
  <td colspan="2" style="border-right:solid 1px">s/d bln ini</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td width="5%">C1</td>
  <?php $sumCelaka['bulan_lalu'] = 0; $sumCelaka['bulan_ini'] = 0; $sumCelaka['total'] = 0; ?>
  <td colspan="6">Manusia (kurang peduli, tidak disiplin kondisi mental,dll) </td>
  <td width="7%"><?php if (isset($kecelakaan['manusia'])) {
    echo $kecelakaan['manusia']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['manusia']['jumlah_bulan_lalu'];
} else
    echo 0; ?></td>
  <td width="6%" align="center">+</td>
  <td width="9%"><?php if (isset($kecelakaan['manusia'])) {
    echo $kecelakaan['manusia']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['manusia']['jumlah_bulan_ini'];
} else
    echo 0; ?></td>
  <td width="3%" align="center">=</td>
  <td width="7%"><?php if (isset($kecelakaan['manusia'])) {
    echo $kecelakaan['manusia']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['manusia']['jumlah_total'];
}else
    echo 0; ?></td>
  <td width="7%" style="border-right:solid 1px">kasus</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>C2</td>
  <td colspan="6">Konstruksi (salah metode konstruksi, salah penggunaan) </td>
  <td><?php if (isset($kecelakaan['konstruksi'])) {
    echo $kecelakaan['konstruksi']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['konstruksi']['jumlah_bulan_lalu'];
}else
    echo 0; ?></td>
  <td align="center">+</td>
  <td><?php if (isset($kecelakaan['konstruksi'])) {
    echo $kecelakaan['konstruksi']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['konstruksi']['jumlah_bulan_ini'];
}else
    echo 0; ?></td>
  <td align="center">=</td>
  <td><?php if (isset($kecelakaan['konstruksi'])) {
    echo $kecelakaan['konstruksi']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['konstruksi']['jumlah_total'];
}else
    echo 0; ?></td>
  <td style="border-right:solid 1px">kasus</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>C3</td>
  <td colspan="6">Alat kerja (alat kerja tidak bekerja semestinya) </td>
  <td><?php if (isset($kecelakaan['alat kerja'])) {
    echo $kecelakaan['alat kerja']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['alat kerja']['jumlah_bulan_lalu'];
}else
    echo 0; ?></td>
  <td align="center">+</td>
  <td><?php if (isset($kecelakaan['alat kerja'])) {
    echo $kecelakaan['alat kerja']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['alat kerja']['jumlah_bulan_ini'];
}else
    echo 0; ?></td>
  <td align="center">=</td>
  <td><?php if (isset($kecelakaan['alat kerja'])) {
    echo $kecelakaan['alat kerja']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['alat kerja']['jumlah_total'];
}else
    echo 0; ?></td>
  <td style="border-right:solid 1px">kasus</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>C4</td>
  <td colspan="6">Lingkungan Kerja (tekanan udara, getaran, bising, dll) </td>
  <td><?php if (isset($kecelakaan['lingkungan kerja'])) {
    echo $kecelakaan['lingkungan kerja']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['lingkungan kerja']['jumlah_bulan_lalu'];
}else
    echo 0; ?></td>
  <td align="center">+</td>
  <td><?php if (isset($kecelakaan['lingkungan kerja'])) {
    echo $kecelakaan['lingkungan kerja']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['lingkungan kerja']['jumlah_bulan_ini'];
}else
    echo 0; ?></td>
  <td align="center">=</td>
  <td><?php if (isset($kecelakaan['lingkungan kerja'])) {
    echo $kecelakaan['lingkungan kerja']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['lingkungan kerja']['jumlah_total'];
}else
    echo 0; ?></td>
  <td style="border-right:solid 1px">kasus</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>C5</td>
  <td colspan="6">Jumlah kecelakaan kerja (C1+C2+C3+C4) </td>
  <td><?php echo $sumCelaka['bulan_lalu']; ?></td>
  <td align="center">+</td>
  <td><?php echo $sumCelaka['bulan_ini']; ?></td>
  <td align="center">=</td>
  <td><?php echo $sumCelaka['total']; ?></td>
  <td style="border-right:solid 1px">kasus</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="14" style="border-right:solid 1px; border-left:solid 1px">D. Kondisi korban kecelakaan</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td colspan="2" style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
   <?php $sumKondisi['bulan_lalu'] = 0; $sumKondisi['bulan_ini'] = 0; $sumKondisi['total'] = 0; ?>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td width="5%">D1</td>
  <td colspan="3">Luka Ringan</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td width="7%"><?php if (isset($kondisi['luka ringan'])) {echo $kondisi['luka ringan']['jumlah_bulan_lalu'];$sumKondisi['bulan_lalu']+=$kondisi['luka ringan']['jumlah_bulan_lalu'];}else echo 0; ?></td>
  <td width="6%">+</td>
  <td width="9%"><?php if (isset($kondisi['luka ringan'])) {echo $kondisi['luka ringan']['jumlah_bulan_ini'];$sumKondisi['bulan_ini']+=$kondisi['luka ringan']['jumlah_bulan_ini'];}else echo 0; ?></td>
  <td width="3%">=</td>
  <td width="7%"><?php if (isset($kondisi['luka ringan'])) {echo $kondisi['luka ringan']['jumlah_total'];$sumKondisi['total']+=$kondisi['luka ringan']['jumlah_total'];}else echo 0; ?></td>
  <td width="7%" style="border-right:solid 1px">orang</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>D2</td>
  <td colspan="3">Luka Berat</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><?php if (isset($kondisi['luka berat'])) {echo $kondisi['luka berat']['jumlah_bulan_lalu'];$sumKondisi['bulan_lalu']+=$kondisi['luka berat']['jumlah_bulan_lalu'];}else echo 0; ?></td>
  <td>+</td>
  <td><?php if (isset($kondisi['luka berat'])) {echo $kondisi['luka berat']['jumlah_bulan_ini'];$sumKondisi['bulan_ini']+=$kondisi['luka berat']['jumlah_bulan_ini'];}else echo 0; ?></td>
  <td>=</td>
  <td><?php if (isset($kondisi['luka berat'])) {echo $kondisi['luka berat']['jumlah_total'];$sumKondisi['total']+=$kondisi['luka berat']['jumlah_total'];}else echo 0; ?></td>
  <td style="border-right:solid 1px">orang</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>D3</td>
  <td colspan="3">Meninggal Dunia</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><?php if (isset($kondisi['meninggal dunia'])) {echo $kondisi['meninggal dunia']['jumlah_bulan_lalu'];$sumKondisi['bulan_lalu']+=$kondisi['meninggal dunia']['jumlah_bulan_lalu'];}else echo 0; ?></td>
  <td>+</td>
  <td><?php if (isset($kondisi['meninggal dunia'])) {echo $kondisi['meninggal dunia']['jumlah_bulan_ini'];$sumKondisi['bulan_ini']+=$kondisi['meninggal dunia']['jumlah_bulan_ini'];}else echo 0; ?></td>
  <td>=</td>
  <td><?php if (isset($kondisi['meninggal dunia'])) {echo $kondisi['meninggal dunia']['jumlah_total'];$sumKondisi['total']+=$kondisi['meninggal dunia']['jumlah_total'];}else echo 0; ?></td>
  <td style="border-right:solid 1px">orang</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>D4</td>
  <td colspan="3">Jumlah Korban Kecelakaan    (D1+D2+D3)</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><?php echo $sumKondisi['bulan_lalu']; ?></td>
  <td>+</td>
  <td><?php echo $sumKondisi['bulan_ini']; ?></td>
  <td>=</td>
  <td><?php echo $sumKondisi['total']; ?></td>
  <td style="border-right:solid 1px">orang</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>(a)</td>
  <td>&nbsp;</td>
  <td>(b)</td>
  <td>&nbsp;</td>
  <td colspan="2" style="border-right:solid 1px">© = (a) + (b)</td>
</tr>
<tr>
  <td colspan="14" style="border-right:solid 1px; border-left:solid 1px">E. TINGKAT KEKERAPAN (FR) DAN TINGKAT KEPARAHAN (SR) SAMPAI DENGAN BULAN INI</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4" align="center"><b>Frequency Rate / FR (Tingkat Kekerapan)</b></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4" align="center"><u>Jumlah Kecelakaan kerja (C5c)</u></td>
  <td rowspan="2">x 1.000.000</td>
  <td rowspan="2" align="center">=</td>
  <td colspan="2" align="center"><?php echo $sumCelaka['total']; ?></td>
  <td colspan="2" rowspan="2" align="center">x 1.000.000</td>
  <td rowspan="2" align="center">=</td>
  <td rowspan="2" align="center">
  <?php 
if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
  echo (
          ($sumCelaka['total']/($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']))
          *1000000
       );
  else echo 0;
  ?></td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4" align="center">Jml Tenaga Kerja (B3c) x jml jam kerja (B2c)</td>
  <td colspan="2" align="center">
  <?php 
  		if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
  			echo ($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']);
		else echo 0;
  ?>
  </td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4" align="center"><b>Saferity Rate / SR (Tingkat Keparahan)</b></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4" align="center"><u>Jumlah kehilangan jam kerja (B4c)</u></td>
  <td rowspan="2" align="center">x 1.000.000</td>
  <td rowspan="2" align="center">=</td>
  <td colspan="2" align="center">
  <?php 
  	if(isset($kerja['jumlah kehilangan jam kerja']))
		echo $kerja['jumlah kehilangan jam kerja']['jumlah_total']; 
	else echo 0; 
	?>
  </td>
  <td colspan="2" rowspan="2" align="center">x 1.000.000</td>
  <td rowspan="2" align="center">=</td>
  <td rowspan="2" align="center">
  <?php
if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']) && isset($kerja['jumlah kehilangan jam kerja']))
  	echo (
		  	($kerja['jumlah kehilangan jam kerja']['jumlah_total']/($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja'][	'jumlah_total'])) * 1000000
		  ); else echo 0;
  ?>
  </td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td colspan="4" align="center">Jml Tenaga Kerja (B3c) x jml jam kerja (B2c)</td>
  <td colspan="2" align="center"> <?php 
  		if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
  			echo ($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']);
		else echo 0;
  ?></td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td style="border-left:solid 1px">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td style="border-right:solid 1px">&nbsp;</td>
</tr>
<tr>
  <td colspan="14" style="border:solid 1px">&nbsp;</td>
</tr>
</table>
