<?php 

/**
* 
*/
class M_panitia extends CI_model
{

private $table = 'panitia';

//panitia
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_panitia', $id)->get ();
}

//mengambil id panitia urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_panitia');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_panitia', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_panitia', $id);
  return $this->db-> delete($this->table);
}

//untuk page pelanggan login
public function view_id_panitia($id='')
{
  //join table tb_pelanggan dan tb_paket di pelanggan
  $id = $this->session->userdata['id_panitia'];
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->where('id_panitia', $id);
  $this->db->order_by('id_panitia');
  return $this->db->get();
}

}