select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_LAPORAN_KECELAKAAN,bulan_lalu.NAMA_LAPORAN_KECELAKAAN) as nama_laporan_kecelakaan
from
(
select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_lalu, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
from laporan_kecelakaan
where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') < '05-2012'
and laporan_kecelakaan.ID_PROYEK = '1'
GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
) bulan_lalu
left join
(
select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_ini, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
from laporan_kecelakaan
where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') = '05-2012'
and laporan_kecelakaan.ID_PROYEK = '1'
GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
) bulan_ini
on bulan_lalu.NAMA_LAPORAN_KECELAKAAN = bulan_ini.NAMA_LAPORAN_KECELAKAAN
union
select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_LAPORAN_KECELAKAAN,bulan_lalu.NAMA_LAPORAN_KECELAKAAN) as nama_laporan_kecelakaan
from
(
select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_lalu, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
from laporan_kecelakaan
where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') < '05-2012'
and laporan_kecelakaan.ID_PROYEK = '1'
GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
) bulan_lalu
left join
(
select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_ini, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
from laporan_kecelakaan
where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') = '05-2012'
and laporan_kecelakaan.ID_PROYEK = '1'
GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
) bulan_ini
on bulan_lalu.NAMA_LAPORAN_KECELAKAAN = bulan_ini.NAMA_LAPORAN_KECELAKAAN
