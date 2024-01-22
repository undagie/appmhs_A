<?php
class MahasiswaModel
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMahasiswa()
    {
        $this->db->query('SELECT mahasiswa.*, programstudi.NamaProgram FROM ' . $this->table . ' JOIN programstudi ON programstudi.ProgramStudiID = mahasiswa.ProgramStudiID');
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE MahasiswaID=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa (Nama, Alamat, TanggalLahir, JenisKelamin, KontakDarurat, ProgramStudiID) VALUES (:nama, :alamat, :tanggal_lahir, :jenis_kelamin, :kontak_darurat, :program_studi_id)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('kontak_darurat', $data['kontak_darurat']);
        $this->db->bind('program_studi_id', $data['program_studi_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET Nama=:nama, Alamat=:alamat, TanggalLahir=:tanggal_lahir,JenisKelamin=:jenis_kelamin, KontakDarurat=:kontak_darurat, ProgramStudiID=:program_studi_id WHERE MahasiswaID=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('kontak_darurat', $data['kontak_darurat']);
        $this->db->bind('program_studi_id', $data['program_studi_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteMahasiswa($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE MahasiswaID=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getJumlahMahasiswaPerProgramStudi()
    {
        $query = "SELECT ps.NamaProgram, COUNT(m.MahasiswaID) as JumlahMahasiswa
              FROM programstudi ps
              LEFT JOIN mahasiswa m ON ps.ProgramStudiID = m.ProgramStudiID
              GROUP BY ps.NamaProgram";

        $this->db->query($query);
        return $this->db->resultSet();
    }
}
