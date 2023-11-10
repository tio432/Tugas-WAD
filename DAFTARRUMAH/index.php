<?php

$conn = mysqli_connect('localhost:3308','root','','daftar_rumah');
$result = mysqli_query($conn,'SELECT * FROM Rumah');

if (isset($_POST['tambah'])) {
    $nama_rumah = $_POST['nama_rumah'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $jenis_tempat = $_POST['jenis_tempat'];
    $tempat = $_POST['tempat'];

    $sql = "INSERT INTO Rumah (nama_rumah, deskripsi, kategori, jenis_tempat, tempat) 
            VALUES ('$nama_rumah', '$deskripsi', '$kategori', '$jenis_tempat', '$tempat')";

    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Data berhasil di tambahkan !');
                document.location.href = 'index.php'; // Ganti 'index.php' dengan halaman yang sesuai
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal di tambah !');
            </script>
        ";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $deleteQuery = mysqli_query($conn, "DELETE FROM Rumah WHERE id = $id");
    if ($deleteQuery) {
        echo "
            <script>
                alert('Data berhasil dihapus!');
                window.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal dihapus. Silakan ulangi.');
                window.location.href = 'index.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rumah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Daftar Rumah Fathi</h1>
        <table class="table table-borderless" border="1px">
        <thead>
            <tr>
            <th scope="col">Rumah</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Kategori</th>
            <th scope="col">Jenis tempat</th>
            <th scope="col">Tempat</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['nama_rumah']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['kategori']; ?></td>
                        <td><?php echo $row['jenis_tempat']; ?></td>
                        <td><?php echo $row['tempat']; ?></td>
                        <td><a href="update.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>  <a href="index.php?delete=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rumah ini?')">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <h1 class="text-center">Tambah </h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nama_rumah" class="form-label">Nama Rumah</label>
                <input type="text" class="form-control" id="nama_rumah" name="nama_rumah" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori">
            </div>
            <div class="mb-3">
                <label for="jenis_tempat" class="form-label">Jenis Tempat</label>
                <input type="text" class="form-control" id="jenis_tempat" name="jenis_tempat">
            </div>
            <div class="mb-3">
                <label for="tempat" class="form-label">Tempat</label>
                <input type="text" class="form-control" id="tempat" name="tempat">
            </div>
            <button type="submit" name="tambah" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin menambah rumah ini?')">Tambah Rumah</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

