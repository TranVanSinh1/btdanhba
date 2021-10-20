<?php 

    //Include constants.php file here
    include('config/db.php');

    // 1. get the ID of Admin to be deleted
    $manv = $_GET['manv'];

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM db_nhanvien WHERE manv=$manv";
    $res = mysqli_query($conn, $sql);
    if($res==TRUE){
        $value='xoa';
        header("Location:index.php?response=$value");
    }else{
        echo 'xoa  tb';
    }
    mysqli_close($conn);

?>