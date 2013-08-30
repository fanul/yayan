<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';

class Query {

    //Database connect
    public function __construct() {
        $query = new DB_Class();
    }

    public function getReportTenagaKerja($proyek, $tanggal) {
        //echo $proyek." ".$tanggal."<br>";
        $result = mysql_query("select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
                    (IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
                    IFNULL(bulan_ini.NAMA_PROGRES_TENAGA_KERJA,bulan_lalu.NAMA_PROGRES_TENAGA_KERJA) as nama_progres_tenaga_kerja
                    from
                    (
                    select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_lalu, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
                    from progress_tenaga_kerja
                    where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') < '$tanggal'
                    and progress_tenaga_kerja.ID_PROYEK = '$proyek'
                    GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
                    ) bulan_lalu
                    left join
                    (
                    select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_ini, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
                    from progress_tenaga_kerja
                    where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') = '$tanggal'
                    and progress_tenaga_kerja.ID_PROYEK = '$proyek'
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
                    where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') < '$tanggal'
                    and progress_tenaga_kerja.ID_PROYEK = '$proyek'
                    GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
                    ) bulan_lalu
                    right join
                    (
                    select sum(progress_tenaga_kerja.JUMLAH_PROGRES_TENAGA_KERJA) as jumlah_bulan_ini, progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
                    from progress_tenaga_kerja
                    where DATE_FORMAT(progress_tenaga_kerja.TANGGAL_PROGRES_TENAGA_KERJA,'%m-%Y') = '$tanggal'
                    and progress_tenaga_kerja.ID_PROYEK = '$proyek'
                    GROUP BY progress_tenaga_kerja.NAMA_PROGRES_TENAGA_KERJA
                    ) bulan_ini
                    on bulan_lalu.NAMA_PROGRES_TENAGA_KERJA = bulan_ini.NAMA_PROGRES_TENAGA_KERJA");
        if ($result)
            return $result;
        else
            return false;
    }

    public function getReportKegiatan($proyek, $tanggal) {
        $result = mysql_query("select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
                            (IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
                            IFNULL(bulan_ini.NAMA_PROGRES_KEGIATAN,bulan_lalu.NAMA_PROGRES_KEGIATAN) as nama_progres_kegiatan
                            from
                            (
                            select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_lalu, progress_kegiatan.NAMA_PROGRES_KEGIATAN
                            from progress_kegiatan
                            where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') < '$tanggal'
                            and progress_kegiatan.ID_PROYEK = '$proyek'
                            GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
                            ) bulan_lalu
                            left join
                            (
                            select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_ini, progress_kegiatan.NAMA_PROGRES_KEGIATAN
                            from progress_kegiatan
                            where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') = '$tanggal'
                            and progress_kegiatan.ID_PROYEK = '$proyek'
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
                            where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') < '$tanggal'
                            and progress_kegiatan.ID_PROYEK = '$proyek'
                            GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
                            ) bulan_lalu
                            right join
                            (
                            select sum(progress_kegiatan.JUMLAH_PROGRES_KEGIATAN) as jumlah_bulan_ini, progress_kegiatan.NAMA_PROGRES_KEGIATAN
                            from progress_kegiatan
                            where DATE_FORMAT(progress_kegiatan.TANGGAL_PROGRES_KEGIATAN,'%m-%Y') = '$tanggal'
                            and progress_kegiatan.ID_PROYEK = '$proyek'
                            GROUP BY progress_kegiatan.NAMA_PROGRES_KEGIATAN
                            ) bulan_ini
                            on bulan_lalu.NAMA_PROGRES_KEGIATAN = bulan_ini.NAMA_PROGRES_KEGIATAN");
        if ($result)
            return $result;
        else
            return false;
    }

    public function getReportKecelakaan($proyek,$tanggal)
    {
        $result = mysql_query("select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
                (IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
                IFNULL(bulan_ini.NAMA_LAPORAN_KECELAKAAN,bulan_lalu.NAMA_LAPORAN_KECELAKAAN) as nama_laporan_kecelakaan
                from
                (
                select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_lalu, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
                from laporan_kecelakaan
                where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') < '$tanggal'
                and laporan_kecelakaan.ID_PROYEK = '$proyek'
                GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
                ) bulan_lalu
                left join
                (
                select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_ini, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
                from laporan_kecelakaan
                where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') = '$tanggal'
                and laporan_kecelakaan.ID_PROYEK = '$proyek'
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
                where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') < '$tanggal'
                and laporan_kecelakaan.ID_PROYEK = '$proyek'
                GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
                ) bulan_lalu
                left join
                (
                select sum(laporan_kecelakaan.JUMLAH_LAPORAN_KECELAKAAN) as jumlah_bulan_ini, laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
                from laporan_kecelakaan
                where DATE_FORMAT(laporan_kecelakaan.TANGGAL_LAPORAN_KECELAKAAN,'%m-%Y') = '$tanggal'
                and laporan_kecelakaan.ID_PROYEK = '$proyek'
                GROUP BY laporan_kecelakaan.NAMA_LAPORAN_KECELAKAAN
                ) bulan_ini
                on bulan_lalu.NAMA_LAPORAN_KECELAKAAN = bulan_ini.NAMA_LAPORAN_KECELAKAAN
                ");
        if ($result)
            return $result;
        else
            return false;
    }
    
    function getReportKondisi($proyek,$tanggal)
    {
        $result = mysql_query("select IFNULL(bulan_ini.jumlah_bulan_ini,0) as jumlah_bulan_ini, IFNULL(bulan_lalu.jumlah_bulan_lalu,0) as jumlah_bulan_lalu,
                (IFNULL(bulan_ini.jumlah_bulan_ini,0) + IFNULL(bulan_lalu.jumlah_bulan_lalu,0)) as jumlah_total,
                IFNULL(bulan_ini.NAMA_KONDISI,bulan_lalu.NAMA_KONDISI) as nama_kondisi
                from
                (
                select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_lalu, laporan_kondisi.NAMA_KONDISI
                from laporan_kondisi
                where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') < '$tanggal'
                and laporan_kondisi.ID_PROYEK = '$proyek'
                GROUP BY laporan_kondisi.NAMA_KONDISI
                ) bulan_lalu
                left join
                (
                select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_ini, laporan_kondisi.NAMA_KONDISI
                from laporan_kondisi
                where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') = '$tanggal'
                and laporan_kondisi.ID_PROYEK = '$proyek'
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
                where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') < '$tanggal'
                and laporan_kondisi.ID_PROYEK = '$proyek'
                GROUP BY laporan_kondisi.NAMA_KONDISI
                ) bulan_lalu
                left join
                (
                select sum(laporan_kondisi.JUMLAH_KONDISI) as jumlah_bulan_ini, laporan_kondisi.NAMA_KONDISI
                from laporan_kondisi
                where DATE_FORMAT(laporan_kondisi.TANGGAL_KONDISI,'%m-%Y') = '$tanggal'
                and laporan_kondisi.ID_PROYEK = '$proyek'
                GROUP BY laporan_kondisi.NAMA_KONDISI
                ) bulan_ini
                on bulan_lalu.NAMA_KONDISI = bulan_ini.NAMA_KONDISI");
        if ($result)
            return $result;
        else
            return false;
    }
    
}

?>
