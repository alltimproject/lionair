<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');
    $this->load->model('acc/m_dashboard');
    $this->load->model('acc/m_laporan');
    //Codeigniter : Write Less Do More
  }

  function refundSuccess()
  {
       $pdf = new FPDF('l','mm','A4');
       // membuat halaman baru
       $pdf->AddPage();
       // setting jenis font yang akan digunakan
       $pdf->SetFont('Arial','B',16);
       $pdf->Cell(190,7,'Laporan REFUND',0,1);
       $pdf->SetFont('Arial','B',7);
       $pdf->Cell(190,7,'TANGGAL '.date('Y-m-d'),0,1);


       foreach ($this->m_laporan->getRefundsuccess()->result() as $row){

           $pdf->Cell(10,7,'',0,1);
           $pdf->SetFont('Arial','B',10);
           $pdf->Cell(50,6,'NO. REFUND',1,0);
           $pdf->Cell(85,6,'PENGAJU REFUND',1,0);
           $pdf->Cell(60,6,'EMAIL',1,0);
           $pdf->Cell(45,6,'TANGGAL REFUND',1,0);
           $pdf->Cell(45,6,'TOTAL',1,1);

           $pdf->SetFont('Arial','',10);

           $pdf->Cell(50,6,$row->no_refund,1,0);
           $pdf->Cell(85,6,$row->refund_name,1,0);
           $pdf->Cell(60,6,$row->refund_email,1,0);
           $pdf->Cell(45,6,$row->tgl_refund,1,0);
           $pdf->Cell(45,6,number_format($row->total_refund),1,1);


       }


   $pdf->Output();
  }

}
