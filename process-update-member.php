<?php
  if(isset($_POST['btnUpdate'])){
    $MaNV      = $_POST['txtMaNV'];
    $tenNV     = $_POST['txtHoTen'];
    $chucVu    = $_POST['txtChucVu'];
    $mayBan    = $_POST['txtMayBan'];
    $email     = $_POST['txtEmail'];
    $soDiDong  = $_POST['txtMobile'];
    $maDV      = $_POST['sltMaDV'];

    require("config/db.php");

    $sql = "UPDATE `db_nhanvien` SET manv='$MaNV', tennv='$tenNV',chucvu = '$chucVu', email='$email', sodidong='$soDiDong' WHERE manv='$MaNV'";


    echo $sql."<br>";

    if(mysqli_query($conn,$sql)==TRUE){
      $value='ok';
      header("Location:index.php?response=$value");
    }else{
      echo 'sua tb';
    }
    mysqli_close($conn);
  }
?>

