<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Update</title>
  </head>
  <body>
    <?php
        // Kết nối Database
        $conn = mysqli_connect('localhost', 'root', '', 'danhba_dhtl');
        if (!$conn) {
            die("Kết nối thất bại  .Kiểm tra lại các tham số    khai báo kết nối");
        }
        $manv = $_GET['manv'];
        $query = mysqli_query($conn, "select * from `db_nhanvien` where manv='$manv'");
        $row = mysqli_fetch_assoc($query);
    ?>
      <header class="p-3  btn-success text-white">
          <div class="container">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                  <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                  <svg class="bi me-2" width="40" height="32" role="img" aria-label="Khởi động" _mstaria-label="2264249"><use xlink:href="#bootstrap"></use></svg>
                  </a>

                  <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                  <li><a href="index.php" class="nav-link px-2 text-white" _msthash="1633359" _msttexthash="44122">Administration</a></li>
                  <li><a href="#" class="nav-link px-2 text-white" _msthash="1633541" _msttexthash="152152">Quản lý danh bạ người dùng</a></li>
                  <li><a href="#" class="nav-link px-2 text-white" _msthash="1633723" _msttexthash="43706">Quản lý danh bạ đơn vị</a></li>
                  <li><a href="#" class="nav-link px-2 text-white" _msthash="1633905" _msttexthash="5116020">Quản lý tài khoản</a></li>
                    
                   </ul>

                  <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                  <input type="search" class="form-control form-control-dark" placeholder="Tìm kiếm..." aria-label="Tìm kiếm" _mstplaceholder="1347073" _mstaria-label="1320163">
                 </form>

                  <div class="text-end">
                  <button type="button" class="btn btn-outline-light me-2" _msthash="1717859" _msttexthash="1457443">Đăng nhập</button>
                  </div>
              </div>
          </div>
      </header>
      <main class="mt-4">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h2>Thêm danh bạ nhân viên</h2>
                <form action="process-update-member.php" method="post">
                  <div class="row mb-3">
                    <label for="txtMaNV" class="col-sm-2 col-form-label">Mã nhân viên</label>
                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $row['manv']; ?>" class="form-control" id="txtMaNV" name="txtMaNV">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="txtHoTen" class="col-sm-2 col-form-label">Tên nhân viên</label>
                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $row['tennv']; ?>" class="form-control" id="txtHoTen" name="txtHoTen">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="txtChucVu" class="col-sm-2 col-form-label">Chức vụ</label>
                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $row['chucvu']; ?>" class="form-control" id="txtChucVu" name="txtChucVu">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="txtMayBan" class="col-sm-2 col-form-label">Số Máy Bàn</label>
                    <div class="col-sm-10">
                      <input type="tel" value="<?php echo $row['mayban']; ?>" class="form-control" id="txtMayBan" name="txtMayBan">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" value="<?php echo $row['email']; ?>" class="form-control" id="txtEmail" name="txtEmail">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="txtMobile" class="col-sm-2 col-form-label">Số di động</label>
                    <div class="col-sm-10">
                      <input type="tel" value="<?php echo $row['sodidong']; ?>" class="form-control" id="txtMobile" name="txtMobile">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="txtMaDV" class="col-sm-2 col-form-label">Tên đơn vị</label>
                    <div class="col-sm-10">
                      <select name="sltMaDV" value="<?php echo $row['tendv']; ?>" id="sltMaDV">
                        <?php
                          require("config/db.php");
                          $sql = "SELECT * FROM db_donvi" ;
                          $result = mysqli_query($conn,$sql);

                          if(mysqli_num_rows($result) > 0){
                            while($row=mysqli_fetch_assoc($result)){
                              echo'<option value="'.$row['madv'].'">'.$row['tendv'].'</option>';
                              
                            }
                          }
                          //dong ket noi
                          mysqli_close($conn);
                        ?>
                     
                         
                      </select>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="btnUpdate">Sửa</button>
                </form>
              </div>
            </div>
        </div>
      </main>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>