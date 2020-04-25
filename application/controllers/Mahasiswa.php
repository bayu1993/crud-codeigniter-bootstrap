<?php

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MahasiswaModel');
    }

    public function index()
    {
        $data = ['title' => 'Data Mahasiswa', 'mhs' => $this->MahasiswaModel->selectAll()];
        $this->load->view('main/view_mhs', $data);
    }

    public function insert()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'required|max_length[8]|is_unique[tbl_mhs.nim]');

        if ($this->form_validation->run() == false) {
            $dataNotif = [
                'title' => 'Terjadi kesalahan',
                'msg' => 'Gagal insert data',
                'classbs' => 'alert-danger'
            ];
            $this->session->set_flashdata($dataNotif);
            redirect('home');
        } else {
            $data = [
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'jurusan' => $this->input->post('jur'),
                'fakultas' => $this->input->post('fak'),
                'angkatan' => $this->input->post('akt')
            ];
            $this->MahasiswaModel->insert($data);
            $dataNotif = [
                'title' => 'Sukses',
                'msg' => 'Berhasil insert data',
                'classbs' => 'alert-success'
            ];
            $this->session->set_flashdata($dataNotif);
            redirect('home');
        }
    }

    public function delete($nim)
    {
        $this->MahasiswaModel->delete($nim);
        $dataNotif = [
            'title' => 'Sukses',
            'msg' => 'Berhasil hapus data',
            'classbs' => 'alert-success'
        ];
        $this->session->set_flashdata($dataNotif);
        redirect('home');
    }

    public function update()
    {
        $nim = $this->input->post('nim');
        $data = [
            'nama' => $this->input->post('nama'),
            'jurusan' => $this->input->post('jur'),
            'fakultas' => $this->input->post('fak'),
            'angkatan' => $this->input->post('akt')
        ];
        $this->MahasiswaModel->update($data, $nim);
        $dataNotif = [
            'title' => 'Sukses',
            'msg' => 'Berhasil update data',
            'classbs' => 'alert-success'
        ];
        $this->session->set_flashdata($dataNotif);
        redirect('home');
    }
}
