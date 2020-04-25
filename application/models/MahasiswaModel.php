<?php

class MahasiswaModel extends CI_Model
{

    public function insert($data)
    {
        $this->db->insert('tbl_mhs', $data);
    }

    public function delete($nim)
    {
        $this->db->delete('tbl_mhs', array('nim' => $nim));
    }

    public function update($data, $nim)
    {
        $this->db->where('nim', $nim);
        $this->db->update('tbl_mhs', $data);
    }

    public function selectAll()
    {
        return $this->db->select('*')->get('tbl_mhs')->result();
    }

    public function selectById($nim)
    {
        return $this->db->select('*')->where('nim', $nim)->get('tbl_mhs')->row();
    }
}
