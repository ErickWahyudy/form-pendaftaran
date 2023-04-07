<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('M_admin');
	}

	public function index()
	{
    $kode_tahun = date('Y');
	 $view = array(
        'judul'            =>'Halaman Administrator',
        'panitia'          => $this->db->get_where('panitia',array('level'=>'Panitia'))->num_rows(),
        'peserta'          => $this->db->get('peserta')->num_rows(),
        'sum_pembayaran'   => $this->db->select_sum('nominal_pembayaran')->get_where('peserta')->row()->nominal_pembayaran,

     );
	 $this->load->view('admin/home',$view);
	}

public function keluar($value='')
{

$this->session->sess_destroy();
echo "<script>alert('Anda Telah Keluar Dari Halaman Administrator')</script>";;
redirect(base_url(''));
}

	
}