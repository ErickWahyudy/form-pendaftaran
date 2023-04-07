<?php 

/**
* 
*/
class M_peserta extends CI_model
{

    private $table1 = 'peserta';
    private $table2 = 'periode';

//peserta	
public function view($value='')
{
    //join table peserta dan periode
    $this->db->select('*');
    $this->db->from($this->table1);
    $this->db->join($this->table2 , 'peserta.id_periode = periode.id_periode');
    $this->db->order_by('id_peserta');
    return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table1)->where ('id_peserta', $id)->get ();
}

//mengambil id peserta urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_peserta');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_peserta', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

//delete 2 table
public function delete($id=''){
  $this->db->where('id_peserta', $id);
  return $this->db-> delete($this->table1);
}


//untuk page peserta login
public function view_id_plg($id='')
{
  //join table peserta dan periode di peserta
  $id = $this->session->userdata['id_peserta'];
  $this->db->select('*');
  $this->db->from($this->table1);
  $this->db->join($this->table2 , 'peserta.id_periode = periode.id_periode');
  $this->db->join($this->table3 , 'peserta.id_maps = tb_maps.id_maps');
  $this->db->where('id_peserta', $id);
  $this->db->order_by('id_peserta');
  return $this->db->get();
}

}
