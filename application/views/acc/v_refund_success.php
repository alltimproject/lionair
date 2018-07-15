<div class="card">
  <div class="card-header">
    <a href="<?= base_url('acc/laporan/refundSuccess') ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
  </div>
</div>
<div class="table-responsive mailbox-messages animated zoomIn">
  <table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>No Refund</th>
        <th>Email Customer</th>
        <th>Total Refund</th>
        <th>Kode Booking</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($data as $key):?>
    <tr>
      <td class="mailbox-name"><?= $key->tgl_refund ?> </td>
      <td class="mailbox-name"><a href="" ><?= $key->no_refund ?> </a></td>
      <td class="mailbox-subject"><b><?= $key->refund_email ?> </b> - <?= $key->refund_name ?>, <?= $key->refund_alamat ?>
      </td>
      <td class="mailbox-attachment"> Rp. <?= number_format($key->total_refund);  ?></td>
      <td class="mailbox-date"><b><?= $key->kd_booking ?></b></td>
    </tr>
    <?php endforeach ?>
    </tbody>
  </table>
  <!-- /.table -->
</div>
