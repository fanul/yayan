select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_KONDISI,bulan_lalu.NAMA_KONDISI) as nama_kondisi
from
(
select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_lalu, laporan_kondisi.NAMA_KONDISI
from laporan_kondisi
where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') < '05-2012'
and laporan_kondisi.ID_PROYEK = '1'
GROUP BY laporan_kondisi.NAMA_KONDISI
) bulan_lalu
left join
(
select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_ini, laporan_kondisi.NAMA_KONDISI
from laporan_kondisi
where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') = '05-2012'
and laporan_kondisi.ID_PROYEK = '1'
GROUP BY laporan_kondisi.NAMA_KONDISI
) bulan_ini
on bulan_lalu.NAMA_KONDISI = bulan_ini.NAMA_KONDISI
union
select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
(IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
IFNULL(bulan_ini.NAMA_KONDISI,bulan_lalu.NAMA_KONDISI) as nama_kondisi
from
(
select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_lalu, laporan_kondisi.NAMA_KONDISI
from laporan_kondisi
where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') < '05-2012'
and laporan_kondisi.ID_PROYEK = '1'
GROUP BY laporan_kondisi.NAMA_KONDISI
) bulan_lalu
left join
(
select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_ini, laporan_kondisi.NAMA_KONDISI
from laporan_kondisi
where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') = '05-2012'
and laporan_kondisi.ID_PROYEK = '1'
GROUP BY laporan_kondisi.NAMA_KONDISI
) bulan_ini
on bulan_lalu.NAMA_KONDISI = bulan_ini.NAMA_KONDISI