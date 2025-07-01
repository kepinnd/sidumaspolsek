<?php
require_once 'connection.php';

header('Content-Type: application/json');
$response = ['success' => false, 'message' => 'Gagal membuat pengaduan.'];

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_role"] !== 'masyarakat') {
    $response['message'] = "Akses ditolak. Silakan login sebagai masyarakat.";
    echo json_encode($response);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id_pelapor = $_SESSION['user_id'];
    $judul_pengaduan = trim($_POST['title'] ?? '');
    $isi_pengaduan = trim($_POST['description'] ?? '');
    $tanggal_kejadian = trim($_POST['date_of_incident'] ?? '');
    $lokasi_kejadian = trim($_POST['location_of_incident'] ?? '');
    $nomor_tiket = "LPR-" . date("Ymd") . "-" . strtoupper(substr(uniqid(), -6)); // Contoh nomor tiket

    if (empty($judul_pengaduan) || empty($isi_pengaduan) || empty($tanggal_kejadian) || empty($lokasi_kejadian)) {
        $response['message'] = "Semua field pengaduan wajib diisi.";
        echo json_encode($response);
        exit;
    }

    $conn->begin_transaction(); // Mulai transaksi

    try {
        $sql_pengaduan = "INSERT INTO pengaduan (user_id_pelapor, nomor_tiket, judul_pengaduan, isi_pengaduan, tanggal_kejadian, lokasi_kejadian, status_pengaduan) 
                          VALUES (?, ?, ?, ?, ?, ?, 'Diajukan')";
        
        $stmt_pengaduan = $conn->prepare($sql_pengaduan);
        if (!$stmt_pengaduan) {
            throw new Exception("Gagal mempersiapkan statement pengaduan: " . $conn->error);
        }
        $stmt_pengaduan->bind_param("isssss", $user_id_pelapor, $nomor_tiket, $judul_pengaduan, $isi_pengaduan, $tanggal_kejadian, $lokasi_kejadian);

        if (!$stmt_pengaduan->execute()) {
            throw new Exception("Gagal menyimpan pengaduan: " . $stmt_pengaduan->error);
        }
        $pengaduan_id = $stmt_pengaduan->insert_id; // Dapatkan ID pengaduan yang baru saja diinsert
        $stmt_pengaduan->close();

        // Handle upload bukti (jika ada)
        if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'video/mp4']; // Sesuaikan
            $file_type = $_FILES['evidence']['type'];
            $file_size = $_FILES['evidence']['size']; // dalam bytes
            $max_file_size = 5 * 1024 * 1024; // Maks 5MB

            if (in_array($file_type, $allowed_types) && $file_size <= $max_file_size) {
                $file_original_name = $_FILES['evidence']['name'];
                $file_extension = pathinfo($file_original_name, PATHINFO_EXTENSION);
                $bukti_filename = "bukti_" . $pengaduan_id . "_" . uniqid() . "." . $file_extension;
                $bukti_target_path = UPLOAD_PATH_BUKTI . $bukti_filename;

                if (move_uploaded_file($_FILES['evidence']['tmp_name'], $bukti_target_path)) {
                    $sql_lampiran = "INSERT INTO lampiran_pengaduan (pengaduan_id, nama_file, path_file, tipe_file, ukuran_file) VALUES (?, ?, ?, ?, ?)";
                    $stmt_lampiran = $conn->prepare($sql_lampiran);
                    if (!$stmt_lampiran) {
                        throw new Exception("Gagal mempersiapkan statement lampiran: " . $conn->error);
                    }
                    // Simpan nama file asli dan path relatif/nama file yang disimpan di server
                    $path_file_db = $bukti_filename; // Simpan nama file saja di DB
                    $stmt_lampiran->bind_param("isssi", $pengaduan_id, $file_original_name, $path_file_db, $file_type, $file_size);
                    
                    if (!$stmt_lampiran->execute()) {
                        throw new Exception("Gagal menyimpan lampiran: " . $stmt_lampiran->error);
                    }
                    $stmt_lampiran->close();
                } else {
                    throw new Exception('Gagal mengupload file bukti.');
                }
            } else {
                throw new Exception('Tipe file bukti tidak valid atau ukuran melebihi batas.');
            }
        }

        $conn->commit(); // Commit transaksi jika semua berhasil
        $response['success'] = true;
        $response['message'] = 'Pengaduan berhasil dibuat dengan nomor tiket: ' . $nomor_tiket;
        $response['ticket_id'] = $nomor_tiket;

    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada kesalahan
        $response['message'] = $e->getMessage();
        // Hapus file yang mungkin sudah terupload jika terjadi error setelah upload
        if (isset($bukti_target_path) && file_exists($bukti_target_path)) {
            unlink($bukti_target_path);
        }
    }

} else {
    $response['message'] = 'Metode request tidak valid.';
}

$conn->close();
echo json_encode($response);
?>