<?php

class ProgramStudi extends Controller
{
    public function __construct()
    {
        if ($_SESSION['session_login'] != 'sudah_login') {
            Flasher::setMessage('Login', 'Tidak ditemukan.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Program Studi';
        $data['program_studi'] = $this->model('ProgramStudiModel')->getAllProgramStudi();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('programstudi/index', $data);
        $this->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Program Studi';
        $data['program_studi'] = $this->model('ProgramStudiModel')->getProgramStudiById($id);
        $data['fakultas'] = $this->model('FakultasModel')->getAllFakultas();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('programstudi/edit', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Program Studi';
        $data['fakultas'] = $this->model('FakultasModel')->getAllFakultas();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('programstudi/create', $data);
        $this->view('templates/footer');
    }

    public function simpanProgramStudi()
    {
        if ($this->model('ProgramStudiModel')->tambahProgramStudi($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/programstudi');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/programstudi');
            exit;
        }
    }

    public function updateProgramStudi()
    {
        if ($this->model('ProgramStudiModel')->updateDataProgramStudi($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location:' . base_url . '/programstudi');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location:' . base_url . '/programstudi');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('ProgramStudiModel')->deleteProgramStudi($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location:' . base_url . '/programstudi');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/programstudi');
            exit;
        }
    }
}
