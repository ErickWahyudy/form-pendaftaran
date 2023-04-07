<?php 
/*model design by Ismarianto Putra Tech Programing
 * http://minangopensource.blogspot.com 
 *
 *
*/
class login_m extends CI_model
{
	
 public function admin($username='',$password='')
 {
  return $this->db->query("SELECT * from pengguna where username='$username' AND password='$password' limit 1");
 }

 public function panitia($nama='', $username='', $no_hp='', $password='')
 {
  return $this->db->query("SELECT * from panitia where (nama='$nama' OR username='$username' OR no_hp='$no_hp') AND password='$password' limit 1");
 }

}