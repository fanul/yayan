select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_PROGRES_KEGIATAN,bulan_lalu.NAMA_PROGRES_KEGIATAN) as nama_progres_kegiatan
from
(
select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_lalu, progress_kegiatan.NAMA_PROGRES_KEGIATAN
from progress_kegiatan
where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') < '05-2012'
and progress_kegiatan.ID_PROYEK = '1'
GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
) bulan_lalu
left join
(
select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_ini, progress_kegiatan.NAMA_PROGRES_KEGIATAN
from progress_kegiatan
where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') = '05-2012'
and progress_kegiatan.ID_PROYEK = '1'
GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
) bulan_ini
on bulan_lalu.NAMA_PROGRES_KEGIATAN = bulan_ini.NAMA_PROGRES_KEGIATAN
union
select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_PROGRES_KEGIATAN,bulan_lalu.NAMA_PROGRES_KEGIATAN) as nama_progres_kegiatan
from
(
select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_lalu, progress_kegiatan.NAMA_PROGRES_KEGIATAN
from progress_kegiatan
where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') < '05-2012'
and progress_kegiatan.ID_PROYEK = '1'
GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
) bulan_lalu
right join
(
select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_ini, progress_kegiatan.NAMA_PROGRES_KEGIATAN
from progress_kegiatan
where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') = '05-2012'
and progress_kegiatan.ID_PROYEK = '1'
GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
) bulan_ini
on bulan_lalu.NAMA_PROGRES_KEGIATAN = bulan_ini.NAMA_PROGRES_KEGIATAN