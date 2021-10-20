<?php
  if(isset($_POST['btnSave'])){
    $MaNV      = $_POST['txtMaNV'];
    $tenNV     = $_POST['txtHoTen'];
    $chucVu    = $_POST['txtChucVu'];
    $mayBan    = $_POST['txtMayBan'];
    $email     = $_POST['txtEmail'];
    $soDiDong  = $_POST['txtMobile'];
    $maDV      = $_POST['sltMaDV'];

    require("config/db.php");

    $sql = "INSERT INTO db_nhanvien(manv,tennv,chucvu,mayban,email,sodidong,madv)
    VALUES('$MaNV','$tenNV','$chucVu','$mayBan','$email','$soDiDong','$maDV')";

    echo $sql."<br>";

    if(mysqli_query($conn,$sql)==TRUE){
      $value='successfully';
      header("Location:index.php?response=$value");
    }else{
      $value='existed';
      header("Location:index.php?response=$value");
    }
    mysqli_close($conn);
  }
?>