<?php
    
    include "config.php";

    $menu = $_POST['menu_id'];
    $login = $_POST['login_id'];
    $date = date('Y-m-d');
    $desc = $_POST['desc'];
    $tindakan = $_POST['tindakan'];
    $NoKartu = $_POST['NoKartu'];

    $code = date("YmdHis");

    echo $menu;

    if($menu == 4) {

        $sql = mysqli_query($conn, "SELECT * FROM t_audit WHERE login_id = '$login' AND menu_id = '4' AND audit_date = '$date' ORDER BY audit_id DESC LIMIT 1");
        $harus_cek = mysqli_num_rows($sql);
        
        if($harus_cek == 1) {
            echo "<script>window.location=('menu.php');</script>";
        } else {
            $qry = mysqli_query($conn, "INSERT INTO t_audit (audit_id, menu_id, login_id) VALUES ('','$menu','$login')");
        }

    } 

    $sql = mysqli_query($conn, "SELECT * FROM t_audit WHERE login_id = '$login' AND menu_id = '$menu' AND audit_date = '$date' ORDER BY audit_id DESC LIMIT 1");
    $harus_cek = mysqli_num_rows($sql);
    
    if($harus_cek == 1) {
        
        echo "<script>window.location=('menu.php');</script>";

    } else {

        $sql = mysqli_query($conn, "SELECT * FROM t_audit WHERE login_id = '$login' AND menu_id = '$menu' ORDER BY audit_id DESC LIMIT 1");
        $row = mysqli_fetch_array($sql);
        $audit_id = $row['audit_id'];

        function compressImage($source, $destination, $quality) {
            // Mendapatkan info gambar
            $imgInfo = getimagesize($source);
            $mime = $imgInfo['mime'];
             
            // Membuat gambar baru dari file yang diupload
            switch($mime){
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    $image = imagecreatefromjpeg($source);
            }
             
            // simpan gambar
            imagejpeg($image, $destination, $quality);
             
            // Return gambar yang dikompres
            return $destination;
        }

        // Lokasi path untuk upload
        $uploadPath = "photo/";
        $allowTypes = array('jpg','png','jpeg','gif');

        // File info 1
        $fileName1 = basename($_FILES["photo1"]["name"]);
        if(!empty($fileName1)) {
            $foto1 = '01'.$NoKartu.$code.'.jpg';
            $imageUploadPath1 = $uploadPath . $foto1;
            $fileType1 = pathinfo($imageUploadPath1, PATHINFO_EXTENSION);

            // Syarat format yang diperbolehkan
            if(in_array($fileType1, $allowTypes)){
                // array gambar sementara
                $imageTemp1 = $_FILES["photo1"]["tmp_name"];
            }
        } else {
            $foto1 = '';
        }

        // File info 2
        $fileName2 = basename($_FILES["photo2"]["name"]);
        if(!empty($fileName2)) {
            $foto2 = '02'.$NoKartu.$code.'.jpg';
            $imageUploadPath2 = $uploadPath . $foto2;
            $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);

            // Syarat format yang diperbolehkan
            if(in_array($fileType2, $allowTypes)){
                // array gambar sementara
                $imageTemp2 = $_FILES["photo2"]["tmp_name"];
            }
        } else {
            $foto2 = '';
        }

         // File info 3
        $fileName3 = basename($_FILES["photo3"]["name"]);
        if(!empty($fileName3)) {
            $foto3 = '03'.$NoKartu.$code.'.jpg';
            $imageUploadPath3 = $uploadPath . $foto3;
            $fileType3 = pathinfo($imageUploadPath3, PATHINFO_EXTENSION);

            // Syarat format yang diperbolehkan
            if(in_array($fileType3, $allowTypes)){
                // array gambar sementara
                $imageTemp3 = $_FILES["photo3"]["tmp_name"];
            }
        } else {
            $foto3 = '';
        }
        
        $qry = mysqli_query($conn, "UPDATE t_audit SET 
                            audit_date = '$date',
                            audit_desc = '$desc',
                            audit_photo1 = '$foto1',
                            audit_photo2 = '$foto2',
                            audit_photo3 = '$foto3',
                            audit_tindakan = '$tindakan'
                            WHERE audit_id = '$audit_id'");

        if($qry) {
            if(!empty($fileName1)) {
                $compressedImage = compressImage($imageTemp1, $imageUploadPath1, 75);
            }

            if(!empty($fileName2)) {
                $compressedImage = compressImage($imageTemp2, $imageUploadPath2, 75);
            }

            if(!empty($fileName3)) {
                $compressedImage = compressImage($imageTemp3, $imageUploadPath3, 75);
            }

            echo "<script>window.location=('menu.php');</script>";

        } else {
            echo "<script>window.location=('menu.php');</script>";
        }

    }


?>   