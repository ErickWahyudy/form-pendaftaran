<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Peserta extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_peserta');
	}

    //peserta
    public function index($value='')
    {
     $view = array('judul'     =>'Data Peserta',
                   'data'      =>$this->m_peserta->view(),);
      $this->load->view('admin/peserta/form',$view);
    }

    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
    
     //mengambil id peserta urut terakhir
     private function id_peserta_urut($value='')
     {
      $this->m_peserta->id_urut();
      $query  = $this->db->get();
      $data   = $query->row_array();
      $id     = $data['id_peserta'];
      $urut   = substr($id, 1, 3);
      $tambah = (int) $urut + 1;
      $karakter = $this->acak_id(6);
      
      if (strlen($tambah) == 1){
      $newID = "P"."00".$tambah.$karakter;
         }else if (strlen($tambah) == 2){
         $newID = "P"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "P".$tambah.$karakter
              };
       return $newID;
     }

  //API add peserta
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'nama',
        'label' => 'nama',
        'rules' => 'required'
      ),
      array(
        'field' => 'alamat',
        'label' => 'alamat',
        'rules' => 'required'
      ),
      array(
        'field' => 'no_hp',
        'label' => 'no_hp',
        'rules' => 'required'
      ),
      array(
        'field' => 'tgl_daftar',
        'label' => 'tgl_daftar',
        'rules' => 'required'
      ),
      array(
        'field' => 'nominal_pembayaran',
        'label' => 'nominal_pembayaran',
        'rules' => 'required'
      )
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => 'Tidak ada data'
      ];
    } else {
      $SQLinsert = [
        'id_peserta'          =>$this->id_peserta_urut(),
        'nama'                =>$this->input->post('nama'),
        'alamat'              =>$this->input->post('alamat'),
        'no_hp'               =>$this->input->post('no_hp'),
        'tgl_daftar'          =>$this->input->post('tgl_daftar'),
        'nominal_pembayaran'  =>$this->input->post('nominal_pembayaran'),
        'bukti_pembayaran'    =>$this->input->post('bukti_pembayaran'),
        'id_periode'          =>$this->input->post('id_periode'),
      ];
      if ($this->m_peserta->add($SQLinsert)) {
        $response = [
          'status' => true,
          'message' => 'Berhasil menambahkan data'
        ];
      } else {
        $response = [
          'status' => false,
          'message' => 'Gagal menambahkan data'
        ];
      }
  }
  
  $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
}

      //API edit peserta
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'
          ),
          array(
            'field' => 'alamat',
            'label' => 'alamat',
            'rules' => 'required'
          ),
          array(
            'field' => 'no_hp',
            'label' => 'no_hp',
            'rules' => 'required'
          ),
          array(
            'field' => 'tgl_daftar',
            'label' => 'tgl_daftar',
            'rules' => 'required'
          ),
          array(
            'field' => 'nominal_pembayaran',
            'label' => 'nominal_pembayaran',
            'rules' => 'required'
          )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'nama'                => $this->input->post('nama'),
            'alamat'              => $this->input->post('alamat'),
            'no_hp'               => $this->input->post('no_hp'),
            'tgl_daftar'          => $this->input->post('tgl_daftar'),
            'nominal_pembayaran'  => $this->input->post('nominal_pembayaran'),
            'bukti_pembayaran'    => $this->input->post('bukti_pembayaran'),
            'id_periode'          => $this->input->post('id_periode')
          ];
          if ($this->m_peserta->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil mengubah data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal mengubah data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }
      
      //API hapus data dari database dan folder
      public function api_hapus($id='')
      {
        if (empty($id)) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $data = $this->m_peserta->view_id($id)->row_array();
          if ($this->m_peserta->delete($id)) {
            unlink('./themes/bukti_bayar/'.$data['bukti_pembayaran']);
            $response = [
              'status' => true,
              'message' => 'Berhasil menghapus data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal menghapus data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }

	
}