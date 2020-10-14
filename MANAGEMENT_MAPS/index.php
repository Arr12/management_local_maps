<?php
require_once("function.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistem Informasi Geografis</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <!-- Bootstrap Core Css -->
    <link href="plugin/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="plugin/material-design-iconic-font/css/font.css">
    <link rel="stylesheet" href="plugin/material-design-iconic-font/css/font1.css">
    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

    <!-- Custom -->
    <link href="css/menu-style.css" type="text/css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet">
    <style>
      #map{
        height:100%;
      }
      html,body{
        height:100%;
        margin:0;
        padding:0;
        background-color:#f3f3f3;
      }
      /* Style the header with a grey background and some padding */
      .header-page {
        background-color: #3c3c3c;
        color:#fff;
        padding: 20px 10px;
        margin-bottom:20px;
      }
      .footer{
        text-align:center;
        margin-top:20px;
        overflow: hidden;
        background-color: #3c3c3c;
        color:#fff;
        padding: 20px 10px;
      }
      div.card{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      }
      .f_panel{
        position: absolute;
        top:100px;
        left:25%;
        z-index:5;
        background-color: #fff;
        padding:5px;
        border:1px solid #999;
        text-align:center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left:10px;
      }
    </style>
  </head>
  <body>
    <div class="header-page">
      <h2 class='logo'>Pemanfaatan Google Maps Marker untuk Menyimpan dan menampilkan Lokasi Tertentu <br /><i style='font-size:22px;'></i></h2>
    </div>
    <div class='container-fluid'>
      <button type='button' id='BtnTambahKategori' class='btn btn-block btn-primary'><i class='material-icons'>grain</i> Tambah Kategori</button>
      <br />
      <div class='row' id='FormInputKategori' style='display:none;'>
        <div class='col-lg-12 col-sm-12 col-xs-12'>
          <div class='card'>
            <div class='header'>
              <h2>Form Input Kategori</h2>
            </div>
            <div class='body'>
              <form action="" method="POST" id='FormKategori'>
                <div class="form-line">
                  <div class='form-group'>
                    <button type='button' class='btn btn-block btn-primary' data-toggle='modal' id='BtnListKategori' data-target='#ListKategori'><i class='material-icons'>visibility</i> List Kategori Tersimpan</button>
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lat">Nama Kategori</label>
                    <input class='form-control' type="text" name="Tipe" id="kategori" value='' />
                  </div>
                </div>
                <div class='form-group form-float'>
                  <div class="dz-message" style='text-align:center;'>
                      <div class="drag-icon-cph">
                          <i class="material-icons">touch_app</i>
                      </div>
                      <h3>Silahkan pilih icon yang akan di upload <br />(<i>Icon Rekomendasi : 51 x 51 px</i>)</h3>
                  </div>
                  <div class="fallback">
                    <input name="file" type="file" id='IconUpload'/>
                  </div>
                </div>
                <input class='form-control' type="hidden" name='TambahKategori' />
                <div class="form-line">
                  <div class='form-group'>
                    <button type='submit' class='btn btn-block btn-success' id='SimpanKategori'><i class='material-icons'>done_all</i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <br />
        </div>
      </div>

      <button type='button' id='BtnTambahLokasi' class='btn btn-block btn-primary'><i class='material-icons'>add_location</i> Tambah Lokasi</button>
      <br />

      <div class='row' id='FormInputLokasi' style='display:none;'>
        <div class='col-lg-12 col-sm-12 col-xs-12'>
          <div class='card'>
            <div class='header'>
              <h2>Form Input Lokasi</h2>
            </div>
            <div class='body'>
              <form action="" method="post" id='FormLokasi'>
                <div class="form-line">
                  <div class='form-group' id='SelectKategori'>
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lat">Nama Lokasi</label>
                    <input class='form-control' type="text" value='' name='lokasi' id='InputLokasi' />
                    <p style='font-size:12px;'>*) Silahkan Klik Lokasi pada Maps untuk mengambil lokasi.</p>
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lat">Alamat</label>
                    <input class='form-control' type="text" name="alamat" value='' id='InputAlamat' />
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lat">Latitude</label>
                    <input class='form-control' type="text" id="lat" name='lat' value='' />
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lng">Longitude</label>
                    <input class='form-control' type="text" id="lng" value='' name='lng' />
                  </div>
                </div>
                <input type="hidden" value='' name='TambahLokasi' />
                <div class="form-line">
                  <div class='form-group'>
                    <button type='button' class='btn btn-primary' id='SimpanLokasi'><i class='material-icons'>done_all</i>Simpan</button>
                    <p style='font-size:12px;'>*) Silahkan Klik Simpan setelah melakukan klik Lokasi pada Maps.</p>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <br />
        </div>
      </div>


      <div class='row'>
        <div class='col-lg-12 col-sm-12 col-xs-12'>
          <div class="card">
            <div class="header">
              <h2>Lokasi Tersimpan</h2>
            </div>
            <div class='body'>
              <form action="" method="post">
                <div class="form-line">
                  <div class='form-group' id='SelectKategori2'>
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group' id='PilihLokasi'>
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lat">Alamat</label>
                    <input class='form-control' type="text" id="alamat" value='' />
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lat">Latitude</label>
                    <input class='form-control' type="text" id="lat_saved" value='' />
                  </div>
                </div>
                <div class="form-line">
                  <div class='form-group'>
                    <label for="lng">Longitude</label>
                    <input class='form-control' type="text" id="lng_saved" value='' />
                  </div>
                </div>
                <button type='button' class='btn btn-block btn-danger' id='ClearLokasiTersimpan'><i class='material-icons'>delete</i> Clear</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <hr />
      <div class='row'>
        <div class='col-lg-12 col-sm-12 col-xs-12'>
          <div class='card'>
            <div class='header'>
              <h2>Maps</h2>
            </div>
            <div class='body' style='height: 400px;' id='map'>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      2020 All Rights Reserved &copy; Muchammad Aryo Puruhito Informatics Engineering Major In Narotama University Surabaya
    </div>
    <?php
    /*
    / MODAL BOOTSTRAP
    */
    ?>
    <div class="modal fade" id="ListKategori" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="largeModalLabel">List Kategori Tersimpan</h4>
              </div>
              <div class="modal-body">
                  <div class='clearfix'>
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover dataTable" id='ListKategoriTabel' style='width:100%;'>
                              <thead>
                                  <tr>
                                      <th>Opsi</th>
                                      <th>Nama</th>
                                  </tr>
                              </thead>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <script type='text/javascript'>
      var map;
      var marker;
      function taruhMarker(map,posisiTitik){
        if(marker){
          marker.setPosition(posisiTitik);
        }else{
          marker = new google.maps.Marker({
            position:posisiTitik,
            map:map,
            animation:google.maps.Animation.BOUNCE,
            icon:"http://narotama.ac.id/webicon.ico"
          });
        }
        document.getElementById('lat').value=posisiTitik.lat();
        document.getElementById('lng').value=posisiTitik.lng();
        console.log("LatLng : "+posisiTitik);
      }
      function initMap(){
        map = new google.maps.Map(document.getElementById('map'), {
          center:{lat:-7.288235,lng:112.7742243},
          zoom:15,
          mapTypeId:google.maps.MapTypeId.ROADMAP,
          // mapTypeId:'satellite',
          heading:90,
          tilt:45,
          rotateControl: true
        });
        map.setTilt(45);
        google.maps.event.addListener(map, 'click', function(event){
          taruhMarker(this, event.latLng);
          console.log(event.latLng);
        });
        // map = new google.maps.Marker({
        //   position:new google.maps.LatLng(-7.288235,112.7742243),
        //   // position:new google.maps.LatLng(-7.3462323,112.7817259),
        //   map:map,
        //   animation:google.maps.Animation.BOUNCE
        // });
      }
      function rotate90(){
        var heading=map.getHeading() || 0;
        map.setHeading(heading+90);
      }
      function autoRotate(){
        LatLng : (-7.289340163242024, 112.77550041675568)
        if(map.getTilt() !== 0){
          window.setInterval(rotate90, 2000);
        }
      }
    </script>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery-1.3.2.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/ui/success-login.js"></script>
    <script src="js/custom-slim-scroll.js"></script>
    <script src="js/pages/ui/dialogs.js"></script>
    <!-- <script async defer src='https://maps.google.com/maps/api/js?key=AIzaSyBVA-EefIAi5SI-UMMIkzYYNURHY9d3gHk&callback=initMap'></script> -->
    <script src='https://maps.google.com/maps/api/js?key=AIzaSyAvWqP3cNlLkF4plEgY6f8DoTNnY3zC3TM&callback=initMap'></script>
    <script>
      function TabelKategori(url){
        $('#ListKategoriTabel').DataTable({
          dom: 'Bfrtip',
          responsive: true,
          buttons: ['copy', 'excel'],
          destroy: true,
          searching: true,
          method:"GET",
          dataType:'json',
          ajax:url,
          columns:[
            {"data":"opsi"},
            {"data":"nama"}
          ],
          order:[[1,'asc']]
        });
      }
      function SelectKategori(){
        $.ajax({
          type:'POST',
          url:'data.php',
          data:'SelectKategori=true',
          dataType:'json',
          success: function(data){
            $('#SelectKategori').html("<label for='lat'>Kategori</label><select id='PilihKategori' name='kategori'><option value=''>Pilih Kategori</option>"+data.option+"</select>");
            $('#PilihKategori').addClass('selectpicker form-control show-tick');
            $('#PilihKategori').attr('data-live-search','true');
            $('#PilihKategori').selectpicker('refresh');
            $('#SelectKategori2').html("<label for='lat'>Kategori</label><select id='PilihKategori2' name='kategori'><option value=''>Pilih Kategori</option>"+data.option+"</select>");
            $('#PilihKategori2').addClass('selectpicker form-control show-tick');
            $('#PilihKategori2').attr('data-live-search','true');
            $('#PilihKategori2').selectpicker('refresh');
          }
        });
      }
      $(document).on('click','#ClearLokasiTersimpan',function(){
        history.go();
      });
      $(document).ready(function(){
        SelectKategori();
      });
      $(document).on('change','#PilihKategori2',function(){
        var x=$(this).val();
        $.ajax({
          type:'POST',
          url:'data.php',
          data:'tempat=true&Id_Tipe='+x,
          dataType:'json',
          success: function(data){
            $('#PilihLokasi').html("<label for='lat'>Lokasi</label><select id='PilihTempat'><option value=''>Pilih Tempat</option>"+data.option+"</select>");
            $('#PilihTempat').addClass('selectpicker form-control show-tick');
            $('#PilihTempat').attr('data-live-search','true');
            $('#PilihTempat').selectpicker('refresh');
          }
        });
      });
      $(document).on('change','#PilihTempat',function(){
        var x=$(this).val();
        $.ajax({
          type:'POST',
          url:'data.php',
          data:'geo=true&Id_Tempat='+x,
          dataType:'json',
          success: function(data){
            $('#alamat').val(data.alamat);
            $('#lat_saved').val(data.lat_saved);
            $('#lng_saved').val(data.lng_saved);
            map = new google.maps.Map(document.getElementById('map'), {
              center:{lat:parseFloat(data.lat_saved),lng:parseFloat(data.lng_saved)},
              zoom:19,
              mapTypeId:google.maps.MapTypeId.ROADMAP,
              heading:90,
              tilt:45,
              rotateControl: true
            });
            marker=new google.maps.Marker({
              position: new google.maps.LatLng(parseFloat(data.lat_saved), parseFloat(data.lng_saved)),
              map: map,
              animation:google.maps.Animation.BOUNCE,
              icon:data.icon
            });
          }
        });
      });

      $(document).on('click','#BtnListKategori',function(){
        var url='data.php?kategori=true';
        TabelKategori(url);
      });

      $('#BtnTambahKategori').on('click',function(){
        if($('#FormInputKategori').is(':hidden')){
          $('#FormInputKategori').show();
        }else{
          $('#FormInputKategori').hide();
        }
      });
      $('#BtnTambahLokasi').on('click',function(){
        if($('#FormInputLokasi').is(':hidden')){
          $('#FormInputLokasi').show();
        }else{
          $('#FormInputLokasi').hide();
        }
      });


      $('#SimpanLokasi').on('click',function(){
        $.ajax({
          type:'POST',
          url:'data.php',
          data:$('#FormLokasi').serialize(),
          success:function(data){
            alert(data);
            $('#InputLokasi').val('');
            $('#InputAlamat').val('');
            $('#lat').val('');
            $('#lng').val('');
            SelectKategori();
          }
        });
      });
      $('#FormKategori').submit(function(e){
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: 'data.php',
            type: 'POST',
            data: formData,
            success: function (data) {
              alert(data);
              $('#kategori').val("");
              $('#IconUpload').val("");
              SelectKategori();
            },
            cache: false,
            contentType: false,
            processData: false
        });
      });
    </script>
  </body>
</html>