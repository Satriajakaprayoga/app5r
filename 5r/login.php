<?php
    ob_start();
    session_start();
    include "config.php";

    if (@$_SESSION['admin']) {
        header("location: menu.php");
    } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
    <title>Form 5R</title>
    <style type="text/css">
        body {
            background: url("assets/img-ss-bg.svg");
            background-size: cover;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0px 4px 4px rgba(1, 1, 1, 0.5);
        }

        .container {
            margin-top: 200px;
        }


        .form-login {
            display: inline-block;
        }

        .btn {
            margin: 10px 0;
            width: 300px;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 100px;
            border: 0px;
            font-size: 18px;
            padding-top: 20px;
            padding-bottom: 20px;
            outline: none;
        }

        .btn-primary {
            background: #6BB098;
            color: #fff;
            box-shadow: 0px 4px 4px 0px rgba(1, 1, 1, 0.5);
        }

        .btn-secondary {
            border: none;
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            font-weight: 500;
        }

        h1 {
            font-weight: 800;
            font-size: 35px;
        }
    </style>
</head>

<body>

    <div class="container">

        <center>
            <h1>Form 5R</h1>
            <p>
                Pastikan Nama dan Area yang di Nilai sesuai<br />
                dengan apa yang tampil di bawah ini
            </p>

            <center>
                <?php 
                    if(isset($_POST['login'])) {
                        $depart = $_GET['depart'];
                        $qry = mysqli_query($conn, "SELECT * FROM m_department WHERE department_id = '$depart'");
                        $row = mysqli_fetch_array($qry);
                        $name = $row['department_name'];
                        echo "Anda Sudah Melakukan Audit di Area ".$name;
                    }
                ?>
            </center>
            <br />
            <div class="form-login">
                <form method="POST" autocomplete="off">
                    <input type="text" class="btn btn-secondary" name="nokartu" placeholder="No Kartu">
                    <select class="btn btn-secondary" name="department" required>
                        <option value="">- Pilih Area -</option>
                        <?php 
                            $query = mysqli_query($conn, "SELECT * FROM m_department");
                            while($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $row['department_id']; ?>"><?php echo $row['department_name']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" name="login" class="btn btn-primary" value="Masuk">
                </form>
            </div>
        </center>

        <?php
            $nokartu = @$_POST['nokartu'];
            $department = @$_POST['department'];

            if (isset($_POST['login'])) {
                if ($nokartu == "" || $department == "") {
                    ?>
                    <script type="text/javascript">alert("No Kartu / Area yang di nilai tidak boleh kosong");</script>
                    <?php
                } else {
                    $sql = mysqli_query($conn, "SELECT * FROM m_login WHERE login_kartu = '$nokartu'");
                    $data = mysqli_fetch_array($sql);
                    $cek = mysqli_num_rows($sql);
                    echo $cek;
                    if ($cek == 1) {
                        if ($data['login_level'] == "auditor") {

                            $login_id = $data['login_id'];
                            $date = date("Y-m-d");

                            $cek_dulu = mysqli_query($conn, "SELECT * FROM t_history WHERE login_id = '$login_id' AND history_date = '$date'");
                            $cek_data = mysqli_fetch_array($cek_dulu);
                            $cek_row = mysqli_num_rows($cek_dulu);

                            $department_id = $cek_data['department_id'];

                            $query1 = mysqli_query($conn, "INSERT INTO t_history VALUES ('','$login_id','$date','$department')");

                            if($cek_row >= 1) {
                                $query2 = mysqli_query($conn, "SELECT * FROM m_department WHERE department_id = '$department_id'");
                                $row2 = mysqli_fetch_array($query2);
                            } else {
                                $query2 = mysqli_query($conn, "SELECT * FROM m_department WHERE department_id = '$department'");
                                $row2 = mysqli_fetch_array($query2);
                            }

                            @$_SESSION['auditor'] = $_SESSION['login_id'] = $data['login_id'];
                            @$_SESSION['auditor'] = $_SESSION['login_fullname'] = $data['login_fullname'];
                            @$_SESSION['auditor'] = $_SESSION['login_kartu'] = $data['login_kartu'];
                            @$_SESSION['auditor'] = $_SESSION['department_id'] = $row2['department_name'];
                            header("location: menu.php");
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('No Kartu yang anda masukan salah');</script>";
                        echo "<script>window.location=('login.php?alert=error')</script>";
                    }
                }
            }
        ?>

    </div>
</body>
</html>
                                                                
<?php ob_end_flush(); } ?>