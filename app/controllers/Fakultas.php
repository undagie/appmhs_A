<?php
class Fakultas extends Controller
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
        $data['title'] = 'Data Fakultas';
        $data['fakultas'] = $this->model('FakultasModel')->getAllFakultas();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('fakultas/index', $data);
        $this->view('templates/footer');
    }

    public function cari()
    {
        $data['title'] = 'Data Fakultas';
        $data['fakultas'] = $this->model('FakultasModel')->cariFakultas();
        $data['key'] = $_POST['key'];
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('fakultas/index', $data);
        $this->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Fakultas';
        $data['fakultas'] = $this->model('FakultasModel')->getFakultasById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('fakultas/edit', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Fakultas';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('fakultas/create', $data);
        $this->view('templates/footer');
    }

    public function simpanFakultas()
    {
        if ($this->model('FakultasModel')->tambahFakultas($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/fakultas');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/fakultas');
            exit;
        }
    }

    public function updateFakultas()
    {
        if ($this->model('FakultasModel')->updateDataFakultas($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location:' . base_url . '/fakultas');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location:' . base_url . '/fakultas');
            exit;
        }
    }

    public function hapus($id)
    {
        $programStudiCount = $this->model('ProgramStudiModel')->getProgramStudiCountByFakultasID($id);

        if ($programStudiCount > 0) {
            Flasher::setMessage('Gagal', 'dihapus, Fakultas tidak dapat dihapus karena terdapat program studi yang terkait.', 'danger');
            header('location: ' . base_url . '/fakultas');
            exit;
        } else {
            if ($this->model('FakultasModel')->deleteFakultas($id) > 0) {
                Flasher::setMessage('Berhasil', 'dihapus', 'success');
                header('location:' . base_url . '/fakultas');
                exit;
            } else {
                Flasher::setMessage('Gagal', 'dihapus', 'danger');
                header('location: ' . base_url . '/fakultas');
                exit;
            }
        }
    }
}
