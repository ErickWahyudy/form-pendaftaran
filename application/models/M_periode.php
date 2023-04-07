<?php 

/**
* 
*/
class M_periode extends CI_model
{

private $table = 'periode';

//periode
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_periode', $id)->get ();
}

//mengambil id periode urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_periode');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_periode', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_periode', $id);
  return $this->db-> delete($this->table);
}

}