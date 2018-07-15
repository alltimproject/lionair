<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tiket extends CI_Model{

  function getpenerbanganRefund($norefund,$wherekdbooking)
  {
    $this->db->select('*');
    $this->db->from('tb_penerbangan');
    $this->db->join('tb_refund_detail','tb_refund_detail.no_penerbangan = tb_penerbangan.no_penerbangan');
    $this->db->join('tb_detail','tb_detail.no_penerbangan = tb_penerbangan.no_penerbangan');
    $this->db->where('tb_detail.kd_booking', $norefund);
    $this->db->where($wherekdbooking);
    return $this->db->get();
  }

}
