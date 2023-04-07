<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // needed ???
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        // error_reporting(0);

        $this->load->model('m_peserta');
        $this->load->model('m_judul');
        $this->load->model('m_informasi');
        $this->load->model('m_periode');
    }

    //peserta
    public function index($value='')
    {
     $data = $this->m_judul->view()->row_array();
     $info = $this->m_informasi->view()->row_array();
     $view = array('judul'              =>$data['sub_judul'],
                    'nama_judul'        =>$data['nama_judul'],
                    'sub_judul'         =>$data['sub_judul'],
                    'judul2'            =>$data['judul2'],
                    'akses_pendaftaran' =>$data['akses_pendaftaran'],
                    'foto_logo'         =>$data['foto_logo'],
                    'periode'           =>$this->db->get('periode')->result_array(),
                    'title'             =>$info['title'],
                    'informasi'         =>$info['informasi'],
                    'file_informasi'    =>$info['file_informasi'],
                   
                );

      $this->load->view('landingpage/register',$view);
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

     private function tanggal($value='')
     {
      $tgl = date('Y-m-d');
      return $tgl;
     }
     
     //mengompres ukuran gambar
     private function compress($source, $destination, $quality) 
     {
         $info = getimagesize($source);
         if ($info['mime'] == 'image/jpeg') 
             $image = imagecreatefromjpeg($source);
         elseif ($info['mime'] == 'image/gif') 
             $image = imagecreatefromgif($source);
         elseif ($info['mime'] == 'image/png') 
             $image = imagecreatefrompng($source);
         imagejpeg($image, $destination, $quality);
         return $destination;
     }

     private function berkas($id='')
   {
     if ($_FILES['bukti_pembayaran']['name'] != '') {
     $config['upload_path']          = './themes/bukti_bayar/';
     $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
     $config['max_size']             = 10000;
     $config['max_width']            = 10000;
     $config['max_height']           = 10000;
     $config['file_name']            = $_FILES['bukti_pembayaran']['name'];
     $this->load->library('upload', $config);
     if (!$this->upload->do_upload('bukti_pembayaran')) {
       $error = array('error' => $this->upload->display_errors());
       $this->session->set_flashdata('error', $error['error']);
       redirect('register');
     } else {
       $data = array('upload_data' => $this->upload->data());
       $this->compress($data['upload_data']['full_path'], $data['upload_data']['full_path'], 40);
       return $data['upload_data']['file_name'];
     }
   } else {
     return '';
   }
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
        'tgl_daftar'          =>$this->tanggal(),
        'nominal_pembayaran'  =>$this->input->post('nominal_pembayaran'),
        'bukti_pembayaran'    =>$this->berkas(),
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
    
}
