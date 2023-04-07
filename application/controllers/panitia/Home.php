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
	 if($this->session->userdata('Panitia') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_panitia');
   $this->load->model('m_informasi');

    
}

	public function index($id='')
  {

	 $view = array(
        'judul'           =>'Halaman Panitia',
        'peserta'         => $this->db->get('peserta')->num_rows(),
        'sum_pembayaran'   => $this->db->select_sum('nominal_pembayaran')->get_where('peserta')->row()->nominal_pembayaran,

        'informasi'           =>$this->m_informasi->view(),
        );
	 $this->load->view('panitia/home',$view);
	}

	
}