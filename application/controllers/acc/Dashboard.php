<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('acc/m_dashboard');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data['title'] = 'Dashboard';
    $this->load->view('acc/include/v_header', $data);

    $this->load->view('acc/v_dashboard');

    $this->load->view('acc/include/v_footer');
  }

  function refundSuccess()
  {
    $data['data'] = $this->m_dashboard->getRefund()->result();
    $this->load->view('acc/v_refund_success', $data);
  }

  function refundProcess()
  {
    $this->load->view('acc/v_refund_process');
  }

}
