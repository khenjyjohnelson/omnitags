<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'Omnitags.php';

class C_tabel_b1 extends Omnitags
{
	// Pages
	// Public Pages


	// Account Only Pages


	// Admin Pages
	public function admin()
	{
		$this->declarew();
		$this->page_session_3();

		$param1 = $this->v_get['tabel_b1_field7'];

		$filter = $this->tl_b1->get_b1_by_field('tabel_b1_field7', $param1);

		if (empty($param1)) {
			$result = $this->tl_b1->get_all_b1();
		} else {
			$result = $filter;
		}

		$data1 = array(
			'title' => lang('tabel_b1_alias_v3_title'),
			'konten' => $this->v3['tabel_b1'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b1']),
			'tbl_b1' => $result,
			'tbl_b7' => $this->tl_b7->get_all_b7(),
			'tabel_b1_field7_value' => $param1,
		);

		$this->load_page('tabel_b1', '_layouts/template', $data1);
	}

	// Archive Page
	public function archive()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_b1_alias_v9_title'),
			'konten' => $this->v9['tabel_b1'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b1']),
			'tbl_b1' => $this->tl_b1->get_all_b1_archive(),
		);

		$this->load_page('tabel_b1', '_layouts/template', $data1);
	}

	// Public Pages
	
	public function history($code = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_b1->get_b1_by_field('tabel_b1_field1', $code)->result();
		$this->check_data($tabel);

		$data1 = array(
			'table_id' => $code,
			'title' => lang('tabel_b1_alias_v11_title'),
			'konten' => $this->v11['tabel_b1'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b1']),
			'tbl_b1' => $this->tl_ot->get_by_field_history('tabel_b1', 'tabel_b1_field1', $code),
			'current' => $this->tl_ot->get_by_field('tabel_b1', 'tabel_b1_field1', $code),
		);

		$this->load_page('tabel_b1', '_layouts/template', $data1);
	}

	public function detail_archive($code = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_b1->get_b1_by_field('tabel_b1_field1', $code)->result();
		$this->check_data($tabel);

		$data1 = array(
			'title' => lang('tabel_b1_alias_v10_title'),
			'konten' => $this->v10['tabel_b1'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b1']),
			'tbl_b1' => $this->tl_b1->get_b1_by_field_archive('tabel_b1_field1', $code),
		);

		$this->load_page('tabel_b1', '_layouts/template', $data1);
	}

	// Print all data
	public function laporan()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_b1_alias_v4_title'),
			'konten' => $this->v4['tabel_b1'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b1']),
			'tbl_b1' => $this->tl_b1->get_all_b1(),
		);

		$this->load_page('tabel_b1', '_layouts/printpage', $data1);
	}

	// Functions
	// Add data
	// Functions
	// Add data
	public function tambah()
	{
		$this->declarew();
		$this->session_3();

		validate_all(
			array(
				$this->v_post['tabel_b1_field2'],
				$this->v_post['tabel_b1_field3'],
				$this->v_post['tabel_b1_field5'],
				$this->v_post['tabel_b1_field6'],
				$this->v_post['tabel_b1_field7'],
			),
			$this->views['flash2'],
			'tambah'
		);

		$tabel_b1_field2 = $this->v_post['tabel_b1_field2'];
		$method = $this->tl_b1->get_b1_by_field('tabel_b1_field2', $tabel_b1_field2);

		// mencari apakah jumlah data kurang dari 1
		if ($method->num_rows() < 1) {

			$gambar = $this->upload_new_image(
				$this->v_post['tabel_b1_field2'],
				$this->v_upload_path['tabel_b1'],
				'tabel_b1_field4',
				$this->file_type1,
				$method
			);

			$code = $this->add_code('tabel_b1', $this->aliases['tabel_b1_field1'], 5, '01');
			
			$data = array(
				$this->aliases['tabel_b1_field1'] => $code,
				$this->aliases['tabel_b1_field2'] => $this->v_post['tabel_b1_field2'],
				$this->aliases['tabel_b1_field3'] => $this->v_post['tabel_b1_field3'],
				$this->aliases['tabel_b1_field4'] => $gambar,
				$this->aliases['tabel_b1_field5'] => $this->v_post['tabel_b1_field5'],
				$this->aliases['tabel_b1_field6'] => $this->v_post['tabel_b1_field6'],
				$this->aliases['tabel_b1_field7'] => $this->v_post['tabel_b1_field7'],

				'created_at' => date("Y-m-d\TH:i:s"),
				'updated_at' => date("Y-m-d\TH:i:s"),
				'updated_by' => userdata($this->aliases['tabel_c2_field1']),
			);

			$aksi = $this->tl_b1->insert_b1($data);
			$this->insert_history('tabel_b1', $data);

			$notif = $this->handle_4b($aksi, 'tabel_b1');

			redirect($_SERVER['HTTP_REFERER']);
		} else {

			set_flashdata($this->views['flash1'], $this->aliases['tabel_b1_field2'] . ' telah digunakan!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// Update data
	// Update data
	public function update()
	{
		$this->declarew();
		$this->session_3();

		$code = $this->v_post['tabel_b1_field1'];

		$tabel = $this->tl_b1->get_b1_by_field('tabel_b1_field1', $code)->result();
		$this->check_data($tabel);

		validate_all(
			array(
				$this->v_post['tabel_b1_field1'],
				$this->v_post['tabel_b1_field2'],
				$this->v_post['tabel_b1_field3'],
				$this->v_post['tabel_b1_field4_old'],
				$this->v_post['tabel_b1_field5'],
				$this->v_post['tabel_b1_field6'],
				$this->v_post['tabel_b1_field7'],
			),
			$this->views['flash3'],
			'ubah' . $code
		);

		$gambar = $this->change_image_advanced(
			'tabel_b1_field2',
			$this->v_upload_path['tabel_b1'],
			'tabel_b1_field4',
			$this->file_type1,
			$tabel
		);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_b1_field2'] => $this->v_post['tabel_b1_field2'],
			$this->aliases['tabel_b1_field3'] => $this->v_post['tabel_b1_field3'],
			$this->aliases['tabel_b1_field4'] => $gambar,
			$this->aliases['tabel_b1_field5'] => $this->v_post['tabel_b1_field5'],
			$this->aliases['tabel_b1_field6'] => $this->v_post['tabel_b1_field6'],
			$this->aliases['tabel_b1_field7'] => $this->v_post['tabel_b1_field7'],

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b1->update_b1($data, $code);
		$this->insert_history('tabel_b1', $data);

		$notif = $this->handle_4c($aksi, 'tabel_b1', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Sync the theme of the website
	public function sync_theme($tabel_b1_field7 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b7->get_b7_by_field('tabel_b1_field7', $tabel_b1_field7)->result();
		$this->check_data($tabel);

		$data = array(
			$this->aliases['tabel_b1_field7'] => $tabel_b1_field7,

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b1->update_all_b1($data);
		$this->insert_history('tabel_b1', $data);

		$notif = $this->handle_4c($aksi, 'tabel_b1', $tabel_b1_field7);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Soft Delete data
	public function soft_delete($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b1->get_b1_by_field('tabel_b1_field1', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b1->update_b1($data, $code);
		$this->insert_history('tabel_b1', $data);

		$notif = $this->handle_4e($aksi, 'tabel_b1', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Soft Delete data
	public function restore($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b1->get_b1_by_field_archive('tabel_b1_field1', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => NULL,
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b1->update_b1($data, $code);
		$this->insert_history('tabel_b1', $data);

		$notif = $this->handle_4e($aksi, 'tabel_b1', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Delete data
	public function delete($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel_b1 = $this->tl_b1->get_b1_by_field_archive('tabel_b1_field1', $code)->result();
		$this->check_data($tabel_b1);
		$img = $tabel_b1[0]->{$this->aliases['tabel_b1_field4']};

		unlink($this->v_upload_path['tabel_b1'] . $img);

		$aksi = $this->tl_b1->delete_b1_by_field('tabel_b1_field1', $code);

		$notif = $this->handle_4e($aksi, 'tabel_b1', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	//Push History Data into current data
	public function push($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_ot->get_by_id_history('tabel_b1', $code)->result();
		$this->check_data($tabel);

		$code = $tabel[0]->{$this->aliases['tabel_b1_field1']};

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_b1_field2'] => $tabel[0]->{$this->aliases['tabel_b1_field2']},

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b1->update_b1($data, $code);

		$notif = $this->handle_4c($aksi, 'tabel_b1', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}
}
