<?php
class LoginModel
{
    private $table = 'pengguna';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkLogin($data)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE NamaPengguna = :username AND KataSandi = :password";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $row = $this->db->single();

        return $row;
    }
}
