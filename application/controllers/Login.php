<?php
/*halaman login utama 

author by Ismarianto Putra TEch Programer */

class Login extends CI_controller
{
	
	function __construct()
	{
	parent::__construct();	
  $this->load->helper('url');
  // needed ???
  $this->load->database();
  $this->load->library('session');
  
	$this->load->model('Login_m');
  $this->load->model('m_judul');
	
	}

   public function index()
   {
   	if(isset($_POST['login'])){
      
      $nama=$this->input->post('username');
      $no_hp=$this->input->post('username');
      $username=$this->input->post('username');
      $password=$this->input->post('password');
     
     //cek data login
     $admin  = $this->Login_m->Admin($username,md5($password));
     $panitia = $this->Login_m->Panitia($nama,$username,$no_hp,md5($password));
     
     if($admin->num_rows() > 0 ){
        $DataAdmin=$admin->row_array();
        $sessionAdmin = array(
            'admin'             => TRUE,
        	  'id_pengguna'       => $DataAdmin['id_pengguna'],
            'username'          => $DataAdmin['username'],
            'password'          => $DataAdmin['password'],
            'nama'              => $DataAdmin['nama'],
            'level'             => $DataAdmin['level'] );        
     $this->session->set_userdata($sessionAdmin);
     $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
     redirect(base_url('admin/home'));


     }elseif($panitia->num_rows() > 0){
        $DataPanitia=$panitia->row_array();
        $sessionPanitia = array(
            'Panitia'       => TRUE,
            'id_panitia'    => $DataPanitia['id_panitia'],
            'no_hp'         => $DataPanitia['no_hp'],
            'username'      => $DataPanitia['username'],
            'password'      => $DataPanitia['password'],
            'nama'          => $DataPanitia['nama'],
            'level'         => 'Panitia',
              );       
    
     $this->session->set_userdata($sessionPanitia);
     $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
     redirect(base_url('panitia/home'));

     }else{
          $pesan='<script>
                  swal({
                      title: "Username / Password Salah Atau Akun Anda Tidak Aktif",
                      type: "error",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
       redirect(base_url('login'));

     }
}else{ 
  $data = $this->m_judul->view()->row_array();
  $x = array(
  	          'judul' =>'Login Aplikasi',
              'nama_judul'        =>$data['nama_judul'],
              'sub_judul'         =>$data['sub_judul'],
              'judul2'            =>$data['judul2'],
              'akses_pendaftaran' =>$data['akses_pendaftaran'],
              'foto_logo'         =>$data['foto_logo'],
            );
  
  $this->load->view('login',$x);

}

   }

}