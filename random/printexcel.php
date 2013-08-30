<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/include/excel/' . 'PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();

$sheet->setCellValue('A1', 'Nama');

$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('B1', 'Kategori Penilaian');
$sheet->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('C1', 'Kriteria Penilaian');
$sheet->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('B2', 'antar muka tampilan menu aplikasi');
$sheet->mergeCells('B2:B4');
$sheet->setCellValue('C2', 'kemudahan'); //1
$sheet->setCellValue('C3', 'kejelasan menu'); //2
$sheet->setCellValue('C4', 'kecepatan akses menu'); //3

$sheet->setCellValue('B5', 'antar muka tampilan marker pada peta');
$sheet->mergeCells('B5:B7');
$sheet->setCellValue('C5', 'kemudahan'); //4
$sheet->setCellValue('C6', 'kejelasan menu'); //5
$sheet->setCellValue('C7', 'kecepatan pengolahan data'); //6

$sheet->setCellValue('B7', 'antar muka tampilan isi berita');
$sheet->mergeCells('B7:B8');
$sheet->setCellValue('C8', 'kejelasan tulisan'); //7
$sheet->setCellValue('C9', 'kecepatan unduh gambar'); //8

$sheet->setCellValue('B9', 'antar muka tampilan isi berita');
$sheet->mergeCells('B9:B10');
$sheet->setCellValue('C10', 'kemudahan'); //9
$sheet->setCellValue('C11', 'kecepatan proses update'); //10

/*
  $sheet->setCellValue('D1', 'Penilaian');
  $sheet->mergeCells('D1:G1');
  $sheet->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

  $sheet->setCellValue('D2', '1');
  $sheet->setCellValue('E2', '2');
  $sheet->setCellValue('F2', '3');
  $sheet->setCellValue('G2', '4');
 * 
 */
$column = 4;

for ($no = 1; $no <= 30; $no++)
{
    $row = 2;
    $sheet->setCellValue(getColumn($column) . '1', $no);
    //1
    $sheet->setCellValue(getColumn($column).$row++,4);
    //2
    $sheet->setCellValue(getColumn($column).$row++,4);
    //3
    $sheet->setCellValue(getColumn($column).$row++,4);
    //4
    $sheet->setCellValue(getColumn($column).$row++,  rand(2, 4));
    //5
    $sheet->setCellValue(getColumn($column).$row++,  rand(2, 4));
    //6
    $sheet->setCellValue(getColumn($column).$row++, 4);
    //7
    $sheet->setCellValue(getColumn($column).$row++, rand(2, 4));
    //8
    $sheet->setCellValue(getColumn($column).$row++, rand(2, 4));
    //9
    $sheet->setCellValue(getColumn($column).$row++,4);
    //10
    $sheet->setCellValue(getColumn($column++).$row++, rand(2, 4));
    

    /*
      
      $pilih = rand(4, 4);
      
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $pilih = rand(4, 4);
      $sheet->setCellValue('C' . $row, 'kejelasan menu');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $pilih = rand(4, 4);
      $sheet->setCellValue('C' . $row, 'kecepatan akses menu');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $sheet->setCellValue('B' . $row, 'antar muka tampilan marker pada peta');
      $pilih = rand(3, 4);
      $sheet->setCellValue('C' . $row, 'kemudahan');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $pilih = rand(3, 4);
      $sheet->setCellValue('C' . $row, 'kejelasan menu');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $pilih = rand(3, 4);
      $sheet->setCellValue('C' . $row, 'kecepatan pengolahan data');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $sheet->setCellValue('B' . $row, 'tampilan isi berita pada aplikasi');
      $pilih = rand(3, 4);
      $sheet->setCellValue('C' . $row, 'kejelasan tulisan');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $pilih = rand(3, 4);
      $sheet->setCellValue('C' . $row, 'kecepatan unduh gambar berita');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $sheet->setCellValue('B' . $row, 'proses update berita pada aplikasi');
      $pilih = rand(3, 4);
      $sheet->setCellValue('C' . $row, 'kemudahan');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);

      $pilih = rand(2, 4);
      $sheet->setCellValue('C' . $row, 'kecepatan proses update');
      if ($pilih == 2)
      $sheet->setCellValue('E' . $row, $pilih);
      else if ($pilih == 3)
      $sheet->setCellValue('F' . $row, $pilih);
      else if ($pilih == 4)
      $sheet->setCellValue('G' . $row, $pilih);
     * */
}


function getColumn($colNumber) {
    $colNumber -=1;
    $huruf = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $string = "";
    
    if ($colNumber < 26)
        return $huruf[$colNumber];
    else {
        
        $div = $colNumber / 25;
        
        if($div > 1)
        {
            if(($colNumber-1)/25 < 2)
            {
                $div = ($colNumber-1) /25;
            }
        }
        
        $carry = $colNumber % 25;
        
        if($carry==0) $carry = 26;
        
        if ($div < 25) {
            $string .= $huruf[$div-1];
            $string .= $huruf[$carry-1];
        } else
        {
            $string .= $huruf[$div-1].getColumn($div);
        }
        
        return $string;
    }
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="rekap_tahunan.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


?>