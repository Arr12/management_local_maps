<?php
ini_set("memory_limit","128M");
// fungsi untuk buat tracer sql
// $stmt->debugDumpParams();
class db{
    public $konek;
	public $selectDB; 
	public $query; 
	public function __construct(){
        $server="localhost";
        $username="root";
        $password="";
        $db="db_maps";
        //koneksikan pada database
        try{
            $this->konek= new PDO("mysql:host=$server;dbname=$db",$username,$password);
            //setting error mode pada PDO
            $this->konek->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed ".$e->getMessage();
        }
    }
    public function __destruct(){
        $this->konek=null;
    }
    public function select($sql){
        try{
            $stmt=$this->konek->prepare($sql);
            $stmt->execute();
            $col=$stmt->rowCount();
            if($col<1){
                echo "";
            }else{
                while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
                    $hasil[]=$result;
                }
                return $hasil;
            }
        }catch(PDOException $e){
            echo "Gagal Mengambil data ".$e->getMessage();
        }
    }
    public function insert($tabel,$kolom,$array){
        try{
            $boolean=false;
            $str_val="'".implode("','",array_values($array))."'";
            $sql="INSERT INTO ".$tabel."($kolom) VALUES ($str_val)";
            $stmt=$this->konek->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo "Gagal Insert data ".$e->getMessage();
        }
    }
    public function update($tabel,$kolom,$array,$id,$ke){
        try{
            $boolean=false;
            $str_val="'".implode("','",array_values($array))."'";
            $sql="UPDATE ".$tabel." SET ".$this->setFormatUpdate($kolom,$array)." WHERE $id='$ke'";
            $stmt=$this->konek->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo "Gagal Update data ".$e->getMessage();
        }
    }
    public function delete($tabel,$id,$ke){
        try{
            $sql="DELETE FROM $tabel WHERE $id='$ke'";
            $stmt=$this->konek->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo "Gagal Delete ".$e->getMessage();
        }
    }
    public function setFormatUpdate($kolom,$array){
        $concat=",";
        foreach($array as $key => $data){
            $result[]=$kolom."='".$data."'";
        }
        $strAttribute=implode($concat,$result);
        return $strAttribute;
    }
}
$crud=new db;
?>
