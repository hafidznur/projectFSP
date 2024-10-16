<?php
    $servername = "localhost"; // Ganti dengan server Anda
    $usename = "root"; // Ganti dengan usename database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "esport"; // Ganti dengan nama database Anda

    // Buat koneksi
    $conn = new mysqli($servername, $usename, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $usename = $_POST['usename'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM member WHERE usename=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usename);
    $stmt->execute();
    $result = $stmt->get_result();

    if( $result->num_rows == 0) {
        $insert_sql = "INSERT INTO member (fname, lname, usename, password, profile) VALUES ('$fname', '$lname', '$usename', '$password', 'member')"; // Ganti 'users' dan 'first_name' sesuai dengan tabel Anda
        $stmt = $conn->prepare($insert_sql);
        

        if ($stmt->execute()) {
            setcookie("usename", $usename, time() + (3600));
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User sudah terdaftar pada database!"; //jadikan alert
    }
    
    $stmt->close();
    $conn->close();
?>

