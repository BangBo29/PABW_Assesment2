<?php
// Koneksi ke database (sesuaikan dengan pengaturan database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_ii";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika terdapat parameter 'id_form' dalam URL, maka proses penghapusan data
if(isset($_GET['id_form'])) {
    // Mendapatkan ID form yang akan dihapus dari parameter URL
    $idForm = $_GET['id_form'];

    // Query untuk menghapus data dari tabel berdasarkan ID form
    $sql = "DELETE FROM permohonan WHERE id_form = $idForm";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Jika tidak ada parameter 'id_form', maka tampilkan data dalam format JSON

    // Query untuk mengambil data dari tabel
    $sql = "SELECT id_form, nik, tanggal, tujuan, deskripsi FROM permohonan";
    $result = $conn->query($sql);

    // Membuat array untuk menyimpan data
    $data = array();

    // Mengambil setiap baris hasil query dan menambahkannya ke dalam array
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Mengubah array menjadi format JSON dan mencetaknya
    echo json_encode($data);
}

// Menutup koneksi
$conn->close();
?>
