<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Informasi extends CI_controller
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
   $this->load->model('m_informasi');
	}

    //informasi
    public function index($value='')
    {
     $view = array('judul'     =>'Informasi',
                   'data'      =>$this->m_informasi->view(),);
      $this->load->view('admin/informasi/form',$view);
    }


      //API edit informasi
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'title',
            'label' => 'title',
            'rules' => 'required'
          ),
          array(
            'field' => 'informasi',
            'label' => 'informasi',
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
            'title'             => $this->input->post('title'),
            'informasi'        => $this->input->post('informasi')
          ];
          if ($this->m_informasi->update($id, $SQLupdate)) {
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
      if ($_FILES['file']['name'] != '') {
      $config['upload_path']          = './themes/file_informasi/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
      $config['max_size']             = 10000;
      $config['max_width']            = 10000;
      $config['max_height']           = 10000;
      $config['file_name']            = $_FILES['file']['name'];
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata('error', $error['error']);
        redirect('admin/informasi');
      } else {
        $data = array('upload_data' => $this->upload->data());
        $this->compress($data['upload_data']['full_path'], $data['upload_data']['full_path'], 40);
        return $data['upload_data']['file_name'];
      }
    } else {
      return '';
    }
    }

      //API upload foto ke database dan folder
      public function api_upload($id='', $SQLupdate='')
      {
        if (empty($_FILES['file']['name'])) {
          $data = [
            'status'  => 'error',
            'message' => 'Tidak Ada File Yang Diupload',
          ];
        } else {
          $SQLupdate = [
            'file_informasi'    => $this->berkas($id)
          ];
          if ($this->m_informasi->update($id, $SQLupdate)) {
            $data = [
              'status'  => 'success',
              'message' => 'Berhasil Upload File',
            ];
          } else {
            $data = [
              'status'  => 'error',
              'message' => 'Gagal Upload File',
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($data));
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
          $data = $this->m_informasi->view_id($id)->row_array();
          if ($this->m_informasi->delete($id)) {
            unlink('./themes/file_informasi/'.$data['file_informasi']);
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