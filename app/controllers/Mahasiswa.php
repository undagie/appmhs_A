<?php
class Mahasiswa extends Controller
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
        $data['title'] = 'Data Mahasiswa';
        $data['mahasiswa'] = $this->model('MahasiswaModel')->getAllMahasiswa();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Mahasiswa';
        $data['program_studi'] = $this->model('ProgramStudiModel')->getAllProgramStudi();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('mahasiswa/create', $data);
        $this->view('templates/footer');
    }

    public function simpanMahasiswa()
    {
        if ($this->model('MahasiswaModel')->tambahMahasiswa($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/mahasiswa');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/mahasiswa');
            exit;
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Mahasiswa';
        $data['program_studi'] = $this->model('ProgramStudiModel')->getAllProgramStudi();
        $data['mahasiswa'] = $this->model('MahasiswaModel')->getMahasiswaById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('mahasiswa/edit', $data);
        $this->view('templates/footer');
    }

    public function updateMahasiswa()
    {
        if ($this->model('MahasiswaModel')->updateDataMahasiswa($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location: ' . base_url . '/mahasiswa');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location: ' . base_url . '/mahasiswa');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('MahasiswaModel')->deleteMahasiswa($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/mahasiswa');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/mahasiswa');
            exit;
        }
    }

    public function lihatlaporan()
    {
        $data['title'] = 'Data Laporan Mahasiswa';
        $data['mahasiswa'] = $this->model('MahasiswaModel')->getAllMahasiswa();
        $this->view('mahasiswa/lihatlaporan', $data);
    }

    public function laporan()
    {
        $data['mahasiswa'] = $this->model('MahasiswaModel')->getAllMahasiswa();
        $pdf = new FPDF('p', 'mm', 'A4');

        // Membuat halaman baru
        $pdf->AddPage();
        // Setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 14);
        // Mencetak string
        $pdf->Cell(190, 7, 'LAPORAN MAHASISWA', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 6, 'Nama', 1);
        $pdf->Cell(30, 6, 'Alamat', 1);
        $pdf->Cell(25, 6, 'Tanggal Lahir', 1);
        $pdf->Cell(30, 6, 'Jenis Kelamin', 1);
        $pdf->Cell(35, 6, 'Program Studi', 1);
        $pdf->Cell(30, 6, 'Kontak Darurat', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['mahasiswa'] as $row) {
            $pdf->Cell(40, 6, $row['Nama'], 1);
            $pdf->Cell(30, 6, $row['Alamat'], 1);
            $pdf->Cell(25, 6, date('d-m-Y', strtotime($row['TanggalLahir'])), 1);
            $pdf->Cell(30, 6, $row['JenisKelamin'], 1);
            $pdf->Cell(35, 6, $row['NamaProgram'], 1);
            $pdf->Cell(30, 6, $row['KontakDarurat'], 1);
            $pdf->Ln();
        }

        $pdf->Output('I', 'Laporan Mahasiswa.pdf', true);
    }

    public function laporanJumlahMahasiswa()
    {
        $data['title'] = 'Laporan Jumlah Mahasiswa per Program Studi';
        $data['programStudi'] = $this->model('ProgramStudiModel')->getAllProgramStudi();
        $data['jumlahMahasiswa'] = $this->model('MahasiswaModel')->getJumlahMahasiswaPerProgramStudi();

        $this->view('mahasiswa/laporan_jml_mhs', $data);
    }
}
