<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'Omnitags.php';

class C_tabel_d4 extends Omnitags
{
	// Pages
	// Public Pages


	// Account Only Pages


	// Admin Pages
	public function admin()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_d4_alias_v3_title'),
			'konten' => $this->v3['tabel_d4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_d4']),
			'tbl_d4' => $this->tl_d4->get_all_d4(),
		);

		$this->load_page('tabel_d4', '_layouts/template', $data1);
	}

	// Print all data
	public function laporan()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_d4_alias_v4_title'),
			'konten' => $this->v4['tabel_d4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_d4']),
			'tbl_d4' => $this->tl_d4->get_all_d4(),
		);

		$this->load_page('tabel_d4', '_layouts/printpage', $data1);
	}

	// Print one data



	// Functions
	// Add data
	public function tambah()
	{
		$this->declarew();
		$this->session_3();

		// $id = get_next_code($this->aliases['tabel_d4'], $this->aliases['tabel_d4_field1'], 'USR');

		$data = array(
			// $this->aliases['tabel_d4_field1'] => $id,
			$this->aliases['tabel_d4_field1'] => '',
			$this->aliases['tabel_d4_field2'] => userdata($this->aliases['tabel_c2_field1']),

			'created_at' => date("Y-m-d\TH:i:s"),
			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_d4->insert_d4($data);
	}
	
	//Soft Delete Data
	public function soft_delete($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_d4->get_d4_by_field('tabel_d4_field1', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_d4->update_d4($data, $code);
		$this->insert_history('tabel_d4', $data);

		$notif = $this->handle_4e($aksi, 'tabel_d4', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Soft Delete data
	public function restore($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_d4->get_d4_by_field_archive('tabel_d4_field1', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => NULL,
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_d4->update_d4($data, $code);
		$this->insert_history('tabel_d4', $data);

		$notif = $this->handle_4e($aksi, 'tabel_d4', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Archive Page
	public function archive()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_d4_alias_v9_title'),
			'konten' => $this->v9['tabel_d4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_d4']),
			'tbl_d4' => $this->tl_d4->get_all_d4_archive(),
		);

		$this->load_page('tabel_d4', '_layouts/template', $data1);
	}

	// Public Pages
	public function detail_archive($code = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_d4->get_d4_by_field('tabel_d4_field1', $code)->result();
		$this->check_data($tabel);

		$data1 = array(
			'title' => lang('tabel_d4_alias_v10_title'),
			'konten' => $this->v10['tabel_d4'],
			'dekor' => $this->tl_d4->dekor($this->theme_id, $this->aliases['tabel_d4']),
			'tbl_d4' => $this->tl_d4->get_d4_by_field_archive('tabel_d4_field1', $code),
		);

		$this->load_page('tabel_d4', '_layouts/template', $data1);
	}
	
	public function history($code = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_d4->get_d4_by_field('tabel_d4_field1', $code)->result();
		$this->check_data($tabel);

		$data1 = array(
			'table_id' => $code,
			'title' => lang('tabel_d4_alias_v11_title'),
			'konten' => $this->v11['tabel_d4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_d4']),
			'tbl_d4' => $this->tl_ot->get_by_field_history('tabel_d4', 'tabel_d4_field1', $code),
			'current' => $this->tl_ot->get_by_field('tabel_d4', 'tabel_d4_field1', $code),
		);

		$this->load_page('tabel_d4', '_layouts/template', $data1);
	}

	//Push History Data into current data
	public function push($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_ot->get_by_id_history('tabel_d4', $code)->result();
		$this->check_data($tabel);

		$code = $tabel[0]->{$this->aliases['tabel_d4_field1']};

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_d4_field2'] => $tabel[0]->{$this->aliases['tabel_d4_field2']},

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_d4->update_d4($data, $code);

		$notif = $this->handle_4c($aksi, 'tabel_d4', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}
}

