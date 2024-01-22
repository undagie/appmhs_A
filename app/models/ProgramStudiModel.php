<?php

class ProgramStudiModel
{
    private $table = 'programstudi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProgramStudi()
    {
        $query = 'SELECT programstudi.*, fakultas.NamaFakultas 
                  FROM programstudi
                  LEFT JOIN fakultas ON programstudi.FakultasID = fakultas.FakultasID';

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getProgramStudiById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ProgramStudiID=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getProgramStudiCountByFakultasID($fakultasID)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM programstudi WHERE FakultasID = :fakultasID');
        $this->db->bind('fakultasID', $fakultasID);
        $row = $this->db->single();
        return $row['count'];
    }

    public function tambahProgramStudi($data)
    {
        $query = "INSERT INTO programstudi(NamaProgram, FakultasID) VALUES (:nama_program, :fakultas_id)";
        $this->db->query($query);
        $this->db->bind('nama_program', $data['nama_program']);
        $this->db->bind('fakultas_id', $data['fakultas_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateDataProgramStudi($data)
    {
        $query = 'UPDATE programstudi SET NamaProgram=:nama_program, FakultasID=:fakultas_id WHERE ProgramStudiID=:id';
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama_program', $data['nama_program']);
        $this->db->bind('fakultas_id', $data['fakultas_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteProgramStudi($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE ProgramStudiID=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
