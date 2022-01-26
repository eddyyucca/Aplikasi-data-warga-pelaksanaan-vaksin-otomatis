<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('jabatan_m');
        // $this->load->model('lowongan_m');
        $this->load->model('admin_m');
        // $this->load->model('alumni_m');

        // $level_akun = $this->session->userdata('level');
        // if ($level_akun != "admin") {
        //     return redirect('auth');
        // }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = false;
        $data['judul'] = 'Dashboard';

        $this->load->view('template/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer', $data);
    }

    // vaksin
    // -------------------- //
    public function vaksin()
    {
        $data['judul'] = 'Data vaksin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_vaksin();
        $this->load->view('template/header', $data);
        $this->load->view('admin/vaksin/data_vaksin', $data);
        $this->load->view('template/footer');
    }
    public function dokter()
    {
        $data['judul'] = 'Data Dokter';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_dokter();
        $this->load->view('template/header', $data);
        $this->load->view('admin/dokter/data_dokter', $data);
        $this->load->view('template/footer');
    }
    public function cetak_data_vaksin()
    {
        $data['judul'] = 'Data vaksin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_vaksin();
        // $this->load->view('template/header', $data);
        $this->load->view('admin/vaksin/cetak_data_vaksin', $data);
        // $this->load->view('template/footer');
    }
    public function tambah_vaksin()
    {
        $data['judul'] = 'Data vaksin';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/vaksin/input_vaksin', $data);
        $this->load->view('template/footer');
    }
    public function tambah_dokter()
    {
        $data['judul'] = 'Data Dokter';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/dokter/input_dokter', $data);
        $this->load->view('template/footer');
    }
    public function edit_vaksin($id_vaksin)
    {
        $data['judul'] = 'Data vaksin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_row_vaksin($id_vaksin);

        $this->load->view('template/header', $data);
        $this->load->view('admin/vaksin/edit_vaksin', $data);
        $this->load->view('template/footer');
    }
    public function update_vaksin($id_vaksin)
    {
        $data['judul'] = 'Data vaksin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_row_vaksin($id_vaksin);

        $this->load->view('template/header', $data);
        $this->load->view('admin/vaksin/update_stok', $data);
        $this->load->view('template/footer');
    }
    public function edit_dokter($id_dokter)
    {
        $data['judul'] = 'Data Dokter';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_row_dokter($id_dokter);

        $this->load->view('template/header', $data);
        $this->load->view('admin/dokter/edit_dokter', $data);
        $this->load->view('template/footer');
    }

    public function update_stok($id_vaksin)
    {
        $stok_masuk = $this->input->post('vaksin_masuk');
        $stok_ada = $this->input->post('jumlah');
        $hasil = $stok_ada + $stok_masuk;
        $data = array(
            "jumlah" => $hasil,
        );
        $this->db->where('id_vaksin', $id_vaksin);
        $this->db->update('vaksin', $data);
        return redirect('admin/vaksin');
    }

    public function proses_update_vaksin($id_vaksin)
    {
        $this->form_validation->set_rules('nama_vaksin', 'Vaksin', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['data'] = $this->admin_m->get_row_vaksin($id_vaksin);
            $data['judul'] = 'Data vaksin';
            $data['nama'] = $this->session->userdata('nama');
            $this->load->view('template/header', $data);
            $this->load->view('admin/vaksin/edit_vaksin', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_vaksin' => $this->input->post('nama_vaksin'),
                'jumlah' => $this->input->post('jumlah'),
            );
            $this->db->where('id_vaksin', $id_vaksin);
            $this->db->update('vaksin', $data);
            return redirect('admin/vaksin');
        }
    }
    public function proses_update_dokter($id_dokter)
    {
        $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required');
        // $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['data'] = $this->admin_m->get_row_vaksin($id_dokter);
            $data['judul'] = 'Data vaksin';
            $data['nama'] = $this->session->userdata('nama');
            $this->load->view('template/header', $data);
            $this->load->view('admin/dokter/edit_dokter', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_dokter' => $this->input->post('nama_dokter'),
            );
            $this->db->where('id_dokter', $id_dokter);
            $this->db->update('dokter', $data);
            return redirect('admin/dokter');
        }
    }
    public function proses_input_vaksin()
    {
        $this->form_validation->set_rules('nama_vaksin', 'Vaksin', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() == FALSE) {

            $data['judul'] = 'Data vaksin';
            $data['nama'] = $this->session->userdata('nama');
            $this->load->view('template/header', $data);
            $this->load->view('admin/vaksin/input_vaksin', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_vaksin' => $this->input->post('nama_vaksin'),
                'jumlah' => $this->input->post('jumlah')
            );
            $this->db->insert('vaksin', $data);
            return redirect('admin/vaksin');
        }
    }
    public function proses_input_dokter()
    {
        $this->form_validation->set_rules('nama_dokter', 'DOkter', 'required');
        // $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() == FALSE) {

            $data['judul'] = 'Data Dokter';
            $data['nama'] = $this->session->userdata('nama');
            $this->load->view('template/header', $data);
            $this->load->view('admin/dokter/input_dokter', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_dokter' => $this->input->post('nama_dokter'),
            );
            $this->db->insert('dokter', $data);
            return redirect('admin/dokter');
        }
    }
    public function hapus_vaksin($id_vaksin)
    {
        $this->db->where('id_vaksin', $id_vaksin);
        $this->db->delete('vaksin');
        return redirect('admin/vaksin');
    }
    public function hapus_dokter($id_dokter)
    {
        $this->db->where('id_dokter', $id_dokter);
        $this->db->delete('dokter');
        return redirect('admin/dokter');
    }


    public function proses_update_lowongan($id_lowongan)
    {
        $this->form_validation->set_rules('nama_lowongan', 'Nama Lowongan', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan');
        $this->form_validation->set_rules('batas_tanggal', 'Batas Tanggal');
        $this->form_validation->set_rules('isi_lowongan', 'Isi Lowongan');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Lowongan Baru';
            $data['nama'] = $this->session->userdata('nama');
            $data['vaksin'] = $this->admin_m->get_all_vaksin();

            $this->load->view('template/header', $data);
            $this->load->view('admin/lowongan/input_lowongan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_lowongan' => $this->input->post('nama_lowongan'),
                'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                'batas_tanggal' => $this->input->post('batas_tanggal'),
                'isi_lowongan' => $this->input->post('isi_lowongan'),
            );
            $this->db->where('id_lowongan', $id_lowongan);

            $this->db->update('lowongan', $data);
            return redirect('admin/data_lowongan');
        }
    }

    public function jadikan_admin($nip)
    {
        $data = array(
            "level" => "admin"
        );
        $this->db->where('nip', $nip);
        $this->db->update('akun', $data);
        return redirect('admin/pegawai');
    }
    public function jadikan_user($nip)
    {
        $data = array(
            "level" => "user"
        );
        $this->db->where('nip', $nip);
        $this->db->update('akun', $data);
        return redirect('admin/pegawai');
    }

    public function lihat_lowongan($id_lowongan)
    {
        $data['judul'] = 'Data Lowongan';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->lowongan_m->get_row_lowongan($id_lowongan);

        $this->load->view('template/header', $data);
        $this->load->view('user/lowongan/lihat_lowongan', $data);
        $this->load->view('template/footer');
    }

    public function update_pegawai($id_pegawai)
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nama_panggilan', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required');
        $this->form_validation->set_rules('ttl', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat_saat_ini', 'Alamat Saat Ini', 'required');
        $this->form_validation->set_rules('alamat_permanen', 'Alamat Permanen', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('hobi', 'Hobi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mulai_bekerja', 'Mulai Bekerja', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('vaksin', 'vaksin', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Data Pegawai';
            $data['nama'] = $this->session->userdata('nama');
            $data['vaksin'] = $this->admin_m->get_all_vaksin();
            $data['jabatan'] = $this->jabatan_m->get_all_jab();
            $data['x'] = $this->pegawai_m->get_row_pegawai($id_pegawai);

            $this->load->view('template/header', $data);
            $this->load->view('admin/pegawai/edit_pegawai', $data);
            $this->load->view('template/footer');
        } else {
            $config['upload_path']   = './assets/foto_profil/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['remove_space'] = TRUE;
            //$config['max_size']      = 100; 
            //$config['max_width']     = 1024; 
            //$config['max_height']    = 768;  

            $this->load->library('upload', $config);
            // script upload file 1
            $y =   $this->upload->do_upload('foto');
            $x = $this->upload->data();

            $data = array(
                'nip' => $this->input->post('nip'),
                'no_ktp' => $this->input->post('no_ktp'),
                'nama' => $this->input->post('nama'),
                'nama_panggilan' => $this->input->post('nama_panggilan'),
                'jk' => $this->input->post('jk'),
                'tempat' => $this->input->post('tempat'),
                'ttl' => $this->input->post('ttl'),
                'alamat_saat_ini' => $this->input->post('alamat_saat_ini'),
                'alamat_permanen' => $this->input->post('alamat_permanen'),
                'no_telp' => $this->input->post('no_telp'),
                'agama' => $this->input->post('agama'),
                'jabatan' => $this->input->post('jabatan'),
                'vaksin' => $this->input->post('vaksin'),
                'hobi' => $this->input->post('hobi'),
                'email' => $this->input->post('email'),
                'mulai_bekerja' => $this->input->post('mulai_bekerja'),
                'foto' =>  $x["orig_name"],
                'status_pegawai' => "Aktif"
            );

            $akun = array(
                'nip' => $this->input->post('nip'),
                'level' => "user"
            );

            $akun_model = $this->pegawai_m->get_row_pegawai2($id_pegawai);

            $this->db->where('id_akun', $akun_model->nip);
            $this->db->update('akun', $akun);

            $this->db->where('id_pegawai', $id_pegawai);
            $this->db->update('pegawai', $data);
            return redirect('admin/pegawai');
        }
    }
    public function delete_vaksin($id_vaksin)
    {
        $this->db->where('id_vaksin', $id_vaksin);
        $this->db->delete('vaksin');

        return redirect('admin/vaksin');
    }

    // Pegawai end
    // -------------------- //

    // menerima pengajuan  
    // -------------------- //
    public function data_lowongan()
    {
        $data['judul'] = 'Data Lowongan';
        $data['data'] = $this->lowongan_m->get_all_lowongan();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/lowongan/data_lowongan', $data);
        $this->load->view('template/footer');
    }
    public function lowongan_lama()
    {
        $data['judul'] = 'Data Lowongan';
        $data['data'] = $this->lowongan_m->get_all_lowongan();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/lowongan/lowongan_lama', $data);
        $this->load->view('template/footer');
    }
    public function pengajuan_kerja()
    {
        $data['judul'] = 'Data Lowongan';
        $data['data'] = $this->alumni_m->get_pengajuan();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/lowongan/pengajuan_kerja', $data);
        $this->load->view('template/footer');
    }
    public function lihat_pelamar($telpon)
    {
        $data['judul'] = 'Alumni';
        $data['nama'] = $this->session->userdata('nama');
        // $telpon =  $this->session->userdata('telpon');
        $data['data'] = $this->alumni_m->get_row_alumni($telpon);
        $this->load->view('template/header', $data);
        $this->load->view('admin/lowongan/lihat_pelamar', $data);
        $this->load->view('template/footer');
    }
    public function semua_pelamar($id_pelamar)
    {
        $data['judul'] = 'Alumni';
        $data['nama'] = $this->session->userdata('nama');
        // $telpon =  $this->session->userdata('telpon');
        $data['data'] = $this->alumni_m->semua_pelamar($id_pelamar);
        $this->load->view('template/header', $data);
        $this->load->view('admin/lowongan/lihat_pelamar', $data);
        $this->load->view('template/footer');
    }

    public function alumni()
    {
        $data['judul'] = 'Data alumni';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->alumni_m->get_all_alumni();

        $this->load->view('template/header', $data);
        $this->load->view('admin/alumni/data_alumni', $data);
        $this->load->view('template/footer');
    }
    public function cetak_alumni()
    {
        $data['judul'] = 'Data alumni';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->alumni_m->get_all_alumni();

        // $this->load->view('template/header', $data);
        $this->load->view('admin/alumni/cetak_data_alumni', $data);
        // $this->load->view('template/footer');
    }


    public function tambah_alumni_baru()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|is_unique[alumni.email]');
        $this->form_validation->set_rules('vaksin_smk', 'vaksin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('pendidikan_t', 'Pendidikan terakhir', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required|is_unique[alumni.telpon]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[alumni.email]');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Data alumni';
            $data['nama'] = $this->session->userdata('nama');
            $data['vaksin'] = $this->admin_m->get_all_vaksin();

            $this->load->view('template/header', $data);
            $this->load->view('admin/alumni/input_alumni', $data);
            $this->load->view('template/footer');
        } else {
            $password = "123456";
            $config['upload_path']   = './assets/foto_profil/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['remove_space'] = TRUE;
            //$config['max_size']      = 100; 
            //$config['max_width']     = 1024; 
            //$config['max_height']    = 768;  

            $this->load->library('upload', $config);
            // script upload file 1
            $this->upload->do_upload('foto');
            $x = $this->upload->data();

            $data = array(
                'nama' => $this->input->post('nama'),
                'vaksin_smk' => $this->input->post('vaksin_smk'),
                'agama' => $this->input->post('agama'),
                'pendidikan_t' => $this->input->post('pendidikan_t'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'alamat' => $this->input->post('alamat'),
                'telpon' => $this->input->post('telpon'),
                'foto_profil' => $x["orig_name"],
                'email' => $this->input->post('email'),
            );
            $akun = array(
                'telpon' => $this->input->post('telpon'),
                'password' => md5($password),
                'level' => "user",
                'status' => "aktif",
            );

            $this->db->insert('alumni', $data);
            $this->db->insert('akun', $akun);
            return redirect('admin/alumni');
        }
    }

    public function view_alumni($telpon)
    {
        $data['judul'] = 'Dashboard Alumni';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->alumni_m->get_row_alumni($telpon);
        $this->load->view('template/header', $data);
        $this->load->view('admin/alumni/view_alumni', $data);
        $this->load->view('template/footer', $data);
    }

    public function tolak($id_lamaran)
    {
        $data = array(
            'status_lamaran' => '2'
        );
        $this->db->where('id_lamaran', $id_lamaran);
        $this->db->update('lamaran', $data);
        redirect("admin/pengajuan_kerja");
    }

    public function terima($id_lamaran)
    {
        $data = array(
            'status_lamaran' => '3'
        );
        $this->db->where('id_lamaran', $id_lamaran);
        $this->db->update('lamaran', $data);
        redirect("admin/pengajuan_kerja");
    }
}

/* End of file Admin.php */
