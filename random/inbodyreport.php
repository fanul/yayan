<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2">Nama</td>
    <td rowspan="2">Kategori Penilaian</td>
    <td rowspan="2">Kriteria  Penilaian</td>
    <td colspan="4">penilaian</td>
  </tr>
  <tr>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
  </tr>
  <?php
    for($no=1; $no<=30; $no++)
        {
  ?>
  <tr>
    <td><?php echo $no ?></td>
    <td rowspan="3">antar muka tampilan menu aplikasi</td>
    <td width="208">Kemudahan</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>v</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>kejelasan menu</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>v</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>kecepatan akses menu</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>v</td>
  </tr>
  <tr>
    <td>&nbsp<?php $pilih = rand(3,4); ?></td>
    <td rowspan="3">antar muka tampilan marker pada peta</td>
    <td>kemudahan</td>
    <td>&nbsp</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <tr>
    <td>&nbsp;<?php $pilih = rand(3,4); ?></td>
    <td>kejelasan menu</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <tr>
    <td>&nbsp;<?php $pilih = rand(3,4); ?></td>
    <td>kecepatan pengolahan data</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <tr>
    <td>&nbsp;<?php $pilih = rand(3,4); ?></td>
    <td rowspan="2">tampilan isi berita pada aplikasi</td>
    <td>kejelasan tulisan</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <tr>
    <td>&nbsp;<?php $pilih = rand(3,4); ?></td>
    <td>kecepatan unduh gambar berita</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <tr>
    <td>&nbsp;<?php $pilih = rand(3,4); ?></td>
    <td rowspan="2">proses update berita pada aplikasi</td>
    <td>kemudahan</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <tr>
    <td>&nbsp;<?php $pilih = rand(2,4); ?></td>
    <td>kecepatan proses update</td>
    <td>&nbsp;</td>
    <td><?php if($pilih==2) echo "v" ?></td>
    <td><?php if($pilih==3) echo "v" ?></td>
    <td><?php if($pilih==4) echo "v" ?></td>
  </tr>
  <?php
    }
  ?>
</table>

<div class="buttons">
    <a href="<?php echo 'printexcel.php' ?>"><input type="button" class="button" value="cetak Excel" /></a>
</div>
