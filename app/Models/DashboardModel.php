<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function grafik()
    {
        $query = "
                    SELECT a.waktu,
                    IFNULL(b.total, 0) AS pemesanan,
                    IFNULL(c.total, 0) AS pengeluaran
                    FROM
                    v_waktu a
                    LEFT OUTER JOIN
                    (
                    SELECT DATE_FORMAT(tanggal_pemesanan, '%Y-%m') AS waktu,
                        SUM(total_harga) AS total
                    FROM pemesanan
                    GROUP BY DATE_FORMAT(tanggal_pemesanan, '%Y-%m')
                    ) b ON (a.waktu = b.waktu)
                    LEFT OUTER JOIN
                    (
                    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS waktu,
                        SUM(jumlah) AS total
                    FROM pengeluaran
                    GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
                    ) c ON (a.waktu = c.waktu) ORDER BY a.waktu; ";
        return $this->db->query($query)->getResultArray();
    }

    public function pemesananPerBulan()
    {
        return $this->db->table('pemesanan')->selectSum('total_harga', 'total_pemesanan')->where('MONTH(tanggal_pemesanan)', date('m'))->get()->getFirstRow();
    }

    public function pengeluaranPerBulan()
    {
        return $this->db->table('pengeluaran')->selectSum('jumlah', 'total_pengeluaran')->where('MONTH(tanggal)', date('m'))->get()->getFirstRow();
    }

    public function countPemesananPerBulan()
    {
        return $this->db->table('pemesanan')->selectCount('total_harga', 'data_pemesanan')->where('MONTH(tanggal_pemesanan)', date('m'))->get()->getFirstRow();
    }

    public function countPengeluaranPerBulan()
    {
        return $this->db->table('pengeluaran')->selectCount('jumlah', 'data_pengeluaran')->where('MONTH(tanggal)', date('m'))->get()->getFirstRow();
    }
    public function getPemesananData()
{
    $query = "
        SELECT IFNULL(SUM(total_harga), 0) AS total
        FROM pemesanan
        GROUP BY DATE_FORMAT(tanggal_pemesanan, '%Y-%m')
        ORDER BY tanggal_pemesanan
    ";
    return $this->db->query($query)->getResultArray();
}

public function getPengeluaranData()
{
    $query = "
        SELECT IFNULL(SUM(jumlah), 0) AS total
        FROM pengeluaran
        GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
        ORDER BY tanggal
    ";
    return $this->db->query($query)->getResultArray();
}

public function getWaktuData()
{
    $query = "
        SELECT DISTINCT DATE_FORMAT(tanggal_pemesanan, '%Y-%m') AS waktu
        FROM pemesanan
        UNION
        SELECT DISTINCT DATE_FORMAT(tanggal, '%Y-%m') AS waktu
        FROM pengeluaran
        ORDER BY waktu
    ";
    return array_column($this->db->query($query)->getResultArray(), 'waktu');
}


}
