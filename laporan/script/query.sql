select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_PROGRES_TENAGA_KERJA,bulan_lalu.NAMA_PROGRES_TENAGA_KERJA) as nama_progres_tenaga_kerja
from
(
select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_lalu, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
from progress_tenaga_kerja
where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') < '05-2012'
and progress_tenaga_kerja.ID_PROYEK = '1'
GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
) bulan_lalu
left join
(
select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_ini, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
from progress_tenaga_kerja
where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') = '05-2012'
and progress_tenaga_kerja.ID_PROYEK = '1'
GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
) bulan_ini
on bulan_lalu.NAMA_PROGRES_TENAGA_KERJA = bulan_ini.NAMA_PROGRES_TENAGA_KERJA
union
select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_PROGRES_TENAGA_KERJA,bulan_lalu.NAMA_PROGRES_TENAGA_KERJA) as nama_progres_tenaga_kerja
from
(
select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_lalu, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
from progress_tenaga_kerja
where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') < '05-2012'
and progress_tenaga_kerja.ID_PROYEK = '1'
GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
) bulan_lalu
right join
(
select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_ini, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
from progress_tenaga_kerja
where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') = '05-2012'
and progress_tenaga_kerja.ID_PROYEK = '1'
GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
) bulan_ini
on bulan_lalu.NAMA_PROGRES_TENAGA_KERJA = bulan_ini.NAMA_PROGRES_TENAGA_KERJA