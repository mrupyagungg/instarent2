<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemesanansTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemesanan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kendaraan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_awal' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tanggal_akhir' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'lama_pemesanan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'total_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_pemesanan', true); // Primary key
        $this->forge->addForeignKey('kendaraan_id', 'kendaraan', 'id_kendaraan', 'CASCADE', 'CASCADE'); // Foreign key
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanans');
    }
}