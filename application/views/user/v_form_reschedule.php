<form class="form-reschedule">
  <div class="wizards">
      <div class="progressbar">
          <div class="progress-line" data-now-value="19.66" data-number-of-steps="5" style="width: 19.66%;"></div> <!-- 19.66% -->
      </div>
      <div class="form-wizard active">
          <div class="wizard-icon"><i class="fa fa-user"></i></div>
          <p>Pilih Tiket</p>
      </div>
      <div class="form-wizard">
          <div class="wizard-icon"><i class="fa fa-plane"></i></div>
          <p>Pilih Rute</p>
      </div>
      <div class="form-wizard">
          <div class="wizard-icon"><i class="fa fa-money"></i></div>
          <p>Pilih Rute Baru</p>
      </div>
      <div class="form-wizard">
          <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
          <p>Form Reschedule</p>
      </div>
      <div class="form-wizard">
          <div class="wizard-icon"><i class="fa fa-lock"></i></div>
          <p>Verifikasi</p>
      </div>
    </div>

    <div class="alert alert-warning"><i class="fa fa-warning"></i></div>

    <fieldset>
      <input type="hidden" name="kd_booking" id="kd_booking" value="<?= $booking ?>">
      <div id="pilih_tiket"></div>
      <div class="wizard-buttons">
          <button type="button" class="btn btn-danger" id="batal">Cancel</button>
          <button type="button" class="btn btn-next" target="pilih-rute">Next</button>
      </div>
    </fieldset>
    <fieldset>
      <div id="pilih_penerbangan"></div>
      <div class="wizard-buttons">
          <button type="button" class="btn btn-previous">Previous</button>
          <button type="button" class="btn btn-next" target="pilih-newrute">Next</button>
      </div>
    </fieldset>
    <fieldset>
      <div id="new_rute"></div>
      <div class="wizard-buttons">
          <button type="button" class="btn btn-previous">Previous</button>
          <button type="button" class="btn btn-next" target="form-reschedule">Next</button>
      </div>
    </fieldset>
    <fieldset>
      <h4 class="title"><i class="fa fa-user"></i> Identitas Reschedule</h4>
      <div class="form-group">
        <label>Gelar</label>
        <select class="form-control" name="reschedul_gelar" id="reschedul_gelar">
          <option value="">--Pilih Gelar--</option>
          <option value="Mr. ">Mr. </option>
          <option value="Mrs. ">Mrs. </option>
        </select>
      </div>
      <div class="form-group">
        <label>Nama Depan</label>
        <input type="text" name="reschedul_first" id="reschedul_first" class="form-control">
      </div>
      <div class="form-group">
        <label>Nama Belakang</label>
        <input type="text" name="reschedul_last" id="reschedul_last" class="form-control">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea name="reschedul_alamat" id="reschedul_alamat" rows="8" cols="80" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Telepon</label>
        <input type="text" name="reschedul_telepon" id="reschedul_telepon" class="form-control">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="reschedul_email" id="reschedul_email" class="form-control">
      </div>
      <div class="wizard-buttons">
          <button type="button" class="btn btn-previous">Previous</button>
          <button type="button" class="btn btn-next" target="verifikasi">Next</button>
      </div>
    </fieldset>
    <fieldset>
      <h4 class="title">Kode Verifikasi</h4>

      <p>
        Kode verifikasi akan dikirim ke email <b id="email_pic"></b>. Klik <button type="button" class="btn btn-sm btn-primary" id="kirim_kode">Kirim Kode</button> untuk mengirimkan Kode Verifikasi.
      </p>

      <div class="form-group">
        <input type="text" name="kode_verifikasi" id="kode_verifikasi" class="form-control" placeholder="6 Digit Kode Verifikasi" maxlength="6">
      </div>
      <div class="wizard-buttons">
          <button type="button" class="btn btn-previous">Previous</button>
          <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button>
      </div>
    </fieldset>
</form>

<script type="text/javascript">
  function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if(direction == 'right') {
      new_value = now_value + ( 100 / number_of_steps );
    }
    else if(direction == 'left') {
      new_value = now_value - ( 100 / number_of_steps );
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
  }

  $(document).ready(function(){
    var kd_booking = $('#kd_booking').val();
    var html_tiket = '';
    var html_rute = '';
    var email_pic;
    var verifikasi;

    // AJAX mengambil Data Booking
      $.ajax({
        url: '<?= base_url('home/cari_booking/') ?>'+kd_booking,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
          if(data.pessenger == '')
          {
            alert('Data tidak ditemukan');
          } else {
              verifikasi = data.verifikasi;
              $.each(data.pessenger, function(k, v){
                html_tiket += '<div class="card">';
                  html_tiket += '<div class="card-body">';
                    // html_tiket += '<h4 class="card-title">E-Ticket '+v.no_tiket+' <div class="pull-right"><input type="checkbox" class="check check-tiket" name="no_tiket[]" value="'+v.no_tiket+'"></div></h4>';
                    html_tiket += '<h4 class="card-title">E-Ticket '+v.no_tiket;
                    html_tiket += '<div class="pull-right">';
                      html_tiket += '<label class="checkbox">';
                        html_tiket += '<span class="switch">';
                        html_tiket += '<input type="checkbox" class="checkbox check-tiket" name="no_tiket[]" value="'+v.no_tiket+'">';
                          html_tiket += '<span class="switch-container">';
                            html_tiket += '<span class="off"><i class="fa fa-close"></i></span>';
                            html_tiket += '<span class="mid"></span>';
                            html_tiket += '<span class="on"><i class="fa fa-check"></i></span>';
                          html_tiket += '</span>';
                        html_tiket += '</span>';
                      html_tiket += '</label>';
                    html_tiket += '</div>';
                    html_tiket += '</h4>';
                    html_tiket += '<p class="card-text"><i class="fa fa-user"></i> '+v.nama_pessenger+' - '+v.tipe_pessenger+'</p>';
                  html_tiket += '</div>';
                html_tiket += '</div>';



                email_pic = v.email;
              });

              html_rute += '<div class="row">';
              var no = 0;
              $.each(data.penerbangan, function(k1, v1){
                no++;
                html_rute += '<div class="card">';
                  html_rute += '<div class="card-body">';
                    html_rute += '<h6 class="card-subtitle mb-2 text-muted">'+v1.no_penerbangan+' - '+v1.class;
                    html_rute += '<div class="pull-right">';
                    html_rute += '<label class="checkbox">';
                      html_rute += '<span class="switch">';
                      html_rute += '<input type="checkbox" class="checkbox check-penerbangan" name="no_penerbangan[]" value="'+v1.no_penerbangan+'">';
                        html_rute += '<span class="switch-container">';
                          html_rute += '<span class="off"><i class="fa fa-close"></i></span>';
                          html_rute += '<span class="mid"></span>';
                          html_rute += '<span class="on"><i class="fa fa-check"></i></span>';
                        html_rute += '</span>';
                      html_rute += '</span>';
                    html_rute += '</label>';
                    html_rute += '</div>';
                    html_rute += '</h6>';
                    html_rute += '<p class="card-text">'+v1.kota_asal+'<br/>'+v1.tgl_keberangkatan+'</p>';
                    html_rute += '<div class="line-home"></div>';
                    html_rute += '<p class="card-text">'+v1.kota_tujuan+'<br/>'+v1.tgl_tiba+'</p>';
                  html_rute += '</div>';
                html_rute += '</div>';
              });
              html_rute += '</div>';

            $('#pilih_tiket').html(html_tiket);
            $('#pilih_penerbangan').html(html_rute);

            // var coba = email_pic.substring(1, 5);
            var coba = email_pic.substr(1, 5);
            $('#email_pic').text(email_pic.replace(coba, "*****"));
          }
        }, error: function(){
          alert('Data tidak ditemukan');
        }
      });

      $('#batal').on('click', function(){
        $('.form-reschedule')[0].reset();
        $('#data').load('<?= base_url('home/term_condition') ?>');

        $("html, body").animate({
          scrollTop: $('body').offset().top
        });
      });

      // Pilih Tiket Muncul pada awal Form
      $('form fieldset:first').fadeIn('slow');
      $('.alert').hide();

      $('form .btn-previous').on('click', function() {
        var current_active_step = $(this).parents('form').find('.form-wizard.active');
        var progress_line = $(this).parents('form').find('.progress-line');

        $(this).parents('fieldset').fadeOut(400, function() {
          current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
          bar_progress(progress_line, 'left');
          $(this).prev().fadeIn();
        });
      });

      $('form .btn-next').on('click', function() {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        var current_active_step = $(this).parents('form').find('.form-wizard.active');
        var progress_line = $(this).parents('form').find('.progress-line');
        var target = $(this).attr('target');

        $("html, body").animate({
          scrollTop: $('.main').offset().top
        });

        switch (target) {
          case 'pilih-rute':
            if($('.check-tiket').is(':checked')) {
              next_step = true;
            } else {
              next_step = false;
              $('.alert').html('<i class="fa fa-warning"></i> Silahkan pilih tiket yang akan direschedule').fadeIn('slow').delay(2500).fadeOut('slow');
            }
          break;

          case 'pilih-newrute':
            if($('.check-penerbangan').is(':checked')) {
              next_step = true;
            } else {
              next_step = false;
              $('.alert').html('<i class="fa fa-warning"></i> Silahkan pilih penerbangan yang akan direschedule').fadeIn('slow').delay(2500).fadeOut('slow');
            }
          break;

          case 'verifikasi':
            var reschedul_gelar = $('#reschedul_gelar').val();
            var reschedul_first = $('#reschedul_first').val();
            var reschedul_last = $('#reschedul_last').val();
            var reschedul_alamat = $('#reschedul_alamat').val();
            var reschedul_telepon = $('#reschedul_alamat').val();
            var reschedul_email = $('#reschedul_email').val();

            if(reschedul_gelar == '' || reschedul_first == '' || reschedul_last == '' || reschedul_alamat == '' || reschedul_telepon == '' || reschedul_email == '') {
              next_step = false;
              $('.alert').html('<i class="fa fa-warning"></i> Mohon lengkapi data pada Form Reschedule').fadeIn('slow').delay(2500).fadeOut('slow');
            } else {
              next_step = true;
            }
          break;

          default:
        }

        if( next_step ) {
          parent_fieldset.fadeOut(400, function() {
            current_active_step.removeClass('active').addClass('activated').next().addClass('active');
            bar_progress(progress_line, 'right');
            $(this).next().fadeIn();
          });
        }
      });

      $('#kirim_kode').on('click', function(){
        $.ajax({
          url: '<?= base_url().'home/mailKode' ?>',
          type: 'POST',
          data: {'email_pic': email_pic},
          success: function(data){
            if(data == 'gagal')
            {
              alert('Gagal mengirim verification code');
            } else {
              verifikasi = data;
            }
            // alert('Success');
          },
          error: function(){
            alert('Tidak Dapat Mengakses Halaman...');
          }
        });
      });

      $('.form-reschedule').submit(function(){
        var kd_verifikasi = $('#kode_verifikasi').val();

        if(kd_verifikasi == ''){
          $('.alert').html('<i class="fa fa-warning"></i> Silahkan masukkan Kode Verifikasi').fadeIn('slow').delay(2500).fadeOut('slow');
        } else if(kd_verifikasi != verifikasi){
          $('.alert').html('<i class="fa fa-warning"></i> Kode Verifikasi tidak dikenali').fadeIn('slow').delay(2500).fadeOut('slow');
        } else {
          $.ajax({
            url: '<?= base_url('home/proses_reschedule') ?>',
            type: 'POST',
            data: $('.form-reschedule').serialize(),
            success: function(data){
              if(data == 'berhasil')
              {
                alert('Berhasil melakukan Reschedule. Silahkan lakukan Upload bukti pembayaran');
                $('#data').load('<?= base_url('home/term_condition') ?>');
              } else {
                alert('Gagal melakukan Refund');
                $('#data').load('<?= base_url('home/term_condition') ?>');
              }
            },
            error: function(){
              alert('Gagal mengakses halaman');
            }
          });
        }
        return false;
      });

      $(document).on('change', '.check-penerbangan, .check-tiket', function(){
        var jumlah_tiket = $('.check-tiket:checked').length;
        var jumlah_penerbangan = $('.check-penerbangan:checked').length;
        var html_newrute = '';
        var i = 0;

        $('.check-penerbangan:checked').each(function(){
          i++;
          html_newrute += '<div class="card">';
            html_newrute += '<div class="card-body">';
              html_newrute += '<div class="form-group">';
                html_newrute += '<input type="date" class="form-control" id="penerbangan'+i+'">';
              html_newrute += '</div>';
              html_newrute += '<div class="form-group">';
                html_newrute += '<input type="text" class="form-control">';
              html_newrute += '</div>';
              html_newrute += '<div class="pull-right">';
                html_newrute += '<button type="button" id="cari-penerbangan" class="btn btn-md btn-info coba">Cari</button>';
              html_newrute += '</div>';
            html_newrute += '</div>';
          html_newrute += '</div>';

          $('#new_rute').html(html_newrute);
        });
      });

      var j = 0;
      $(document).on('click', '.coba', function(){

        $(this).each(function(){
          j++;
          var tgl_penerbangan = $(`#penerbangan${j}`).val();
          $('.data-penerbangan').text(tgl_penerbangan);
          $('#myModal').modal('show');
        });
      });
  });


  // var now = new Date();
  // var jam = 60*60*1000;
  // var denda = 0;
  // var ID = v1.harga_tiket*0.10;
  //
  // var selisih = Math.abs(Math.abs(now - new Date(v1.tgl_keberangkatan))/jam);
  // if(selisih > 72){
  //   denda += 0.25*v1.harga_tiket;
  // } else if (selisih <= 72 && selisih > 4) {
  //   denda += 0.50*v1.harga_tiket;
  // } else if (selisih <= 4) {
  //   denda += parseInt((0.90*v1.harga_tiket)+50000+5000+ID);
  // }

  // html_rute += '<div class="col-md-6">';
  //   html_rute += '<div class="card card-nav-tabs text-white flight">';
  //     html_rute += '<div class="card-header card-header-default" style="color: black;">';
  //       html_rute += '<b>Flight '+v1.no_penerbangan+' - '+v1.class+'</b>';
  //       html_rute += '<div class="pull-right">';
  //         html_rute += '<input type="checkbox" class="check-penerbangan" name="no_penerbangan[]" value="'+v1.no_penerbangan+'" data-harga="'+v1.harga_tiket+'" data-tgl="'+v1.tgl_keberangkatan+'" data-denda="'+denda+'">';
  //       html_rute += '</div>';
  //
  //     html_rute += '</div>';
  //     html_rute += '<div class="row">';
  //       html_rute += '<div class="col-md-4 col-5">';
  //         html_rute += '<div class="text-center">';
  //           html_rute += '<h5>'+v1.kota_asal+'<br/>'+v1.tgl_keberangkatan+'</h5>';
  //         html_rute += '</div>';
  //
  //       html_rute += '</div>';
  //       html_rute += '<div class="col-md-4 col-2">';
  //         html_rute += '<div class="text-center">';
  //           html_rute += '<h5>';
  //           html_rute += '<span class="fa fa-plane fa-2x"></span>';
  //           html_rute += '<div class="route"></div>';
  //           html_rute += '</h5>';
  //         html_rute += '</div>';
  //       html_rute += '</div>';
  //
  //       html_rute += '<div class="col-md-4 col-5">';
  //         html_rute += '<div class="text-center">';
  //           html_rute += '<h5>'+v1.kota_tujuan+'<br/>'+v1.tgl_tiba+'</h5>';
  //         html_rute += '</div>';
  //       html_rute += '</div>';
  //     html_rute += '</div>';
  //   html_rute += '</div>';
  // html_rute += '</div>';


</script>
