<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sekolah extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 15,
				'auto_increment' => TRUE
			],
			'nama_sekolah' => [
				'type' => 'VARCHAR',
				'constraint' => 70
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => 70
			],
			'jenjang' => [
				'type' => 'ENUM("SD","SMP","SMA","SMK")'
			],
			'kepala_sekolah' => [
				'type' => 'VARCHAR',
				'constraint' => 70
			],
			'foto_sekolah' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'deskripsi' => [
				'type' => 'TEXT'
			],
			'status' => [
				'type' => 'ENUM("Negeri","Swasta")'
			],
			'akreditas' => [
				'type' => 'ENUM("A","B","C","Belum Terakreditas")'
			],
			'website' => [
				'type' => 'VARCHAR',
				'constraint' => 30
			],
			'latitude' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'longitude' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'created_at' => [
				'type' => 'DATETIME'
			],
			'updated_at' => [
				'type' => 'DATETIME'
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('tbl_sekolah');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
