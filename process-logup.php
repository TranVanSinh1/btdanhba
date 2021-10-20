<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    // echo '<pre>';
    // echo print_r($_POST);
    // echo '</pre>';
    // Nhận giá trị từ FORM register gửi sang:
    $mand       = $_POST['mand'];
    $tendn      = $_POST['tendn'];
    $email      = $_POST['email'];
    $pass1      = $_POST['pass1'];
    $pass2      = $_POST['pass2'];
    // Kiểm tra pass1 === pass2 (Javascript kiểm tra luôn)
    // QUY TRÌNH 4 (3) bước
    // Bước 01:
    include('config/db.php');

    // Bước 02: Thực hiện các truy vấn
    // 2.1 - Kiểm tra Email này đã tồn tại chưa?
    $sql_1 = "SELECT * FROM db_nguoidung WHERE email='$email'";
    $result_1 = mysqli_query($conn,$sql_1);

    if(mysqli_num_rows($result_1) > 0){
        $value='existed';
        header("Location:logup.php?response=$value");
    }else{
        // 2.2 - Nếu ko tồn tại thì mới LƯU
        // Băm mật khẩu
        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
        $str=rand();
        $code=md5($str);
        $sql_2 = "INSERT INTO db_nguoidung(mand, tendangnhap, email, matkhau) VALUES ('$mand','$tendn','$email','$pass_hash')";
        $result_2 = mysqli_query($conn,$sql_2); //Vì lệnh thực hiện là INSERT: kết quả trả về của $result_2 là SỐ BẢN GHI CHÈN THÀNH CÔNG (SỐ NGUYÊN)
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
            $mail->isSMTP();// gửi mail SMTP
            $mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->Username = 'transinh1642001@gmail.com';// SMTP username
            $mail->Password = '0904790860tranvansinh'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to
            $mail->CharSet = 'UTF-8';
            //Recipients
            $mail->setFrom('transinh1642001@gmail.com', 'Văn phòng Khoa CNTT - Trường ĐH Thủy lợi');
        
            $mail->addReplyTo('transinh1642001@gmail.com', 'Văn phòng Khoa CNTT - Trường ĐH Thủy lợi');
              
            $mail->addAddress('transinh1642001@gmail.com'); // Add a recipient
            
        
            // Content
            $mail->isHTML(true);   // Set email format to HTML
            $tieude = '[Kích hoạt tài khoản] Đại học thủy lợi';
            $mail->Subject = $tieude;
            
            // Mail body content 
            $bodyContent = '<p>Chúc mừng <b>bạn đã đăng ký thành công tài khoản</b></h1>'; 
            $bodyContent .= '<p>Bạn vui lòng nhấp vào đường link dưới đây để kích hoạt tài khoản</p>'; 
            $bodyContent .= '<p><a href="http://localhost:81/webdb/admin/activation.php?accout='.$email.'&code='.$code.'">Click here</p>';
            
            $mail->Body = $bodyContent;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if($mail->send()){
                echo 'Thư đã được gửi đi';
            }else{
                echo 'Lỗi. Thư chưa gửi được';
            }  
        
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }



        if($result_2 > 0){
            $value='successfully';
            header("Location:logup.php?response=$value");
        }
    }
    

?>