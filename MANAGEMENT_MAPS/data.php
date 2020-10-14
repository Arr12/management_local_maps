<?php
require_once("function.php");
if(isset($_GET['kategori'])){
  $sql=$crud->select("SELECT Id_Tipe,Tipe FROM tipe");
  if(count($sql)!=0){
    foreach($sql as $key => $data){
      $opsi="<button class='btn btn-danger' data-id='$data[Id_Tipe]' id='BtnHapusKategori'><i class='material-icons'>delete</i></button>";
      $data_array[]=array(
        'opsi'        => $opsi,
        'nama'        => $data['Tipe'],
      );
    }
  }else{
    $data_array[]=array(
      'opsi'        => '',
      'nama'        => ''
    );
  }
  $value['data']=$data_array;
  echo json_encode($value);
}
else if(isset($_POST['tempat'])){
  $id_tipe=$_POST['Id_Tipe'];
  $sql=$crud->select("SELECT Id_Tempat,Nama_Tempat,Alamat FROM tempat WHERE Id_Tipe='$id_tipe' ORDER BY Id_Tipe DESC");
  if(count($sql)!=0){
    foreach($sql as $Key => $data){
      $a[]="<option value='$data[Id_Tempat]'>$data[Nama_Tempat]</option>";
      $val['option'] = $a;
    }
  }
  echo json_encode($val);
}
else if(isset($_POST['geo'])){
  $id_tempat=$_POST['Id_Tempat'];
  $sql=$crud->select("SELECT Id_Tempat,Nama_Tempat,Alamat,Lat,Lng,Id_Tipe FROM tempat WHERE Id_Tempat='$id_tempat' ORDER BY Id_Tipe DESC");
  if(count($sql)!=0){
    foreach($sql as $Key => $data){
      $sql=$crud->select("SELECT Image_Path FROM tipe WHERE Id_Tipe='$data[Id_Tipe]' ORDER BY Id_Tipe DESC");
      if(count($sql)!=0){
        foreach($sql as $Key => $value){
          $val['icon'] = $value['Image_Path'];
        }
      }else{
        $val['icon'] = "http://narotama.ac.id/webicon.ico";
      }
      $val['alamat'] = $data['Alamat'];
      $val['lat_saved'] = $data['Lat'];
      $val['lng_saved'] = $data['Lng'];
    }
  }else{
    $val['alamat'] = 'Kosong';
    $val['lat_saved'] = 'Kosong';
    $val['lng_saved'] = 'Kosong';
    $val['icon'] = "http://narotama.ac.id/webicon.ico";
  }
  echo json_encode($val);
}
else if(isset($_POST['SelectKategori'])){
  $sql=$crud->select("SELECT Id_Tipe,Tipe FROM tipe ORDER BY Id_Tipe DESC");
  if(count($sql)!=0){
    foreach($sql as $Key => $data){
      $a[]="<option value='$data[Id_Tipe]'>$data[Tipe]</option>";
      $val['option'] = $a;
    }
  }
  echo json_encode($val);
}
else if(isset($_POST['TambahKategori'])){
  $Tipe=$_POST['Tipe'];
  $foto = $_FILES['file']['name'];
  if($foto!=''){
    $ekstensi_diperbolehkan	= array('png','jpg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];	
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 1044070){
        $inject_filename=uniqid() . "_" . time();
        $new_file_name=$inject_filename .".".$ekstensi;
        $Image_Path='img/icon/'.$new_file_name;
        move_uploaded_file($file_tmp, $Image_Path);
        $array=array($Tipe,$Image_Path);
        $success=$crud->insert('tipe','Tipe,Image_Path',$array);
        $alert="KATEGORI BERHASIL DI TAMBAHKAN";
      }else{
        $alert="UKURAN FILE TERLALU BESAR, PASTIKAN UKURAN FILE < 1 MB";
      }
    }else{
      $alert="EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
    }
  }else{
    $Image_Path='';
    $array=array($Tipe,$Image_Path);
    $success=$crud->insert('tipe','Tipe,Image_Path',$array);
    $alert="KATEGORI BERHASIL DI TAMBAHKAN";
  }
  echo $alert;
}
else if(isset($_POST['TambahLokasi'])){
  $kategori=$_POST['kategori'];
  $lokasi=$_POST['lokasi'];
  $alamat=$_POST['alamat'];
  $lat=$_POST['lat'];
  $lng=$_POST['lng'];
  if(empty($kategori)){
    $alert='PILIH KATEGORI LOKASI';  
  }
  else if(empty($lokasi)){
    $alert='INPUTKAN NAMA LOKASI';  
  }
  else if(empty($alamat)){
    $alert='INPUTKAN ALAMAT';  
  }
  else if(empty($lat)){
    $alert='INPUTKAN LATITUDE DENGAN CARA KLIK LOKASI PADA MAP';
  }
  else if(empty($lng)){
    $alert='INPUTKAN LONGITUDE DENGAN CARA KLIK LOKASI PADA MAP';  
  }
  else{
    $Nama_Tempat=$lokasi;
    $Alamat=$alamat;
    $Id_Tipe=$kategori;
    $Lat=$lat;
    $Lng=$lng;
    $array=array($Nama_Tempat,$Alamat,$Id_Tipe,$Lat,$Lng);
    $success=$crud->insert('tempat','Nama_Tempat,Alamat,Id_Tipe,Lat,Lng',$array);
    $alert='LOKASI BERHASIL DI TAMBAHKAN';
  }
  echo $alert;
}
else{
  print_r($_POST);
  print_r($_FILES);
}
?>