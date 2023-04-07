<?php 

/**
* 
*/
class M_admin extends CI_model
{

private $table = 'pengguna';

//Admin INTERNET
public function view($value='')
{
 return $this->db->select ('*')->from ($this->table)->get ();
}

public function admin($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_pengguna', $id)->get ();
}

//mengambil id pengguna urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_pengguna');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_pengguna', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_pengguna', $id);
  return $this->db-> delete($this->table);
}


}