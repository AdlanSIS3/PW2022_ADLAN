<!DOCTYPE html>
<html>
<head>
	<title>Halaman admin - www.PW2022_ADLAN.com</title>
</head>
<body>
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "akademik";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nim                = "";
$nama               = "";
$jurusan            = "";
$alamat             = "";
$telephone          = "";
$agama              = "";
$jeniskelamin       = "";
$sukses             = "";
$error              = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id                 = $_GET['id'];
    $sql1               = "select * from mahasiswa where id = '$id'";
    $q1                 = mysqli_query($koneksi, $sql1);
    $r1                 = mysqli_fetch_array($q1);
    $nim                = $r1['nim'];
    $nama               = $r1['nama'];
    $jurusan            = $r1['jurusan'];
    $alamat             = $r1['alamat'];
    $telephone          = $r1['telephone'];
    $agama              = $r1['agama'];
    $jeniskelamin       = $r1['jeniskelamin'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nim                = $_POST['nim'];
    $nama               = $_POST['nama'];
    $jurusan            = $_POST['jurusan'];
    $alamat             = $_POST['alamat'];
    $telephone          = $_POST['telephone'];
    $agama              = $_POST['agama'];
    $jeniskelamin       = $_POST['jeniskelamin'];

    if ($nim && $nama && $jurusan && $alamat && $telephone && $agama && $jeniskelamin) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nim = '$nim',nama='$nama',jurusan='$jurusan',alamat='$alamat',telephone='$telephone', agama='$agama',jeniskelamin='$jeniskelamin' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(nim,nama,jurusan,alamat,telephone,agama) values ('$nim','$nama','$jurusan','$alamat','$telephone','$agama')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1000px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                MASUKAN DATA
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jurusan" id="jurusan">
                                <option value="">- Pilih jurusan -</option>
                                <option value="TEKNIK INFORMATIKA" <?php if ($jurusan == "TEKNIK INFORMATIKA") echo "selected" ?>>TEKNIK INFORMATIKA</option>
                                <option value="SISTEM INFORMASI" <?php if ($jurusan == "SISTEM INFORMASI") echo "selected" ?>>SISTEM INFORMASI</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-sm-2 col-form-label">Telephone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $telephone ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama" id="agama">
                                <option value="">- Pilih Agama -</option>
                                <option value="ISLAM" <?php if ($agama == "ISLAM") echo "selected" ?>>ISLAM</option>
                                <option value="KRISTEN" <?php if ($agama == "KRISTEN") echo "selected" ?>>KRISTEN</option>
                                <option value="HINDU" <?php if ($agama == "HINDU") echo "selected" ?>>HINDU</option>
                                <option value="BUDHA" <?php if ($agama== "BUDHA") echo "selected" ?>>BUDHA</option>
                                <option value="KOGHUCU" <?php if ($agama == "KONGHUCU") echo "selected" ?>>KONGHUCU</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jeniskelamin" id="jeniskelamin">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L" <?php if ($jeniskelamin == "L") echo "selected" ?>>L</option>
                                <option value="P" <?php if ($jeniskelamin == "P") echo "selected" ?>>P</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mahasiswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id             = $r2['id'];
                            $nim            = $r2['nim'];
                            $nama           = $r2['nama'];
                            $jurusan        = $r2['jurusan'];
                            $alamat         = $r2['alamat'];
                            $telephone      = $r2['telephone'];
                            $agama          = $r2['agama'];
                            $jeniskelamin   = $r2['jeniskelamin'];

                            

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++  ?></th>
                                <td scope="row"><?php echo $nim     ?></td>
                                <td scope="row"><?php echo $nama    ?></td>
                                <td scope="row"><?php echo $jurusan     ?></td>
                                <td scope="row"><?php echo $alamat  ?></td>
                                <td scope="row"><?php echo $telephone   ?></td>
                                <td scope="row"><?php echo $agama   ?></td>
                                <td scope="row"><?php echo $jeniskelamin     ?></td>
                                <td scope="row">
                                    <a href="halaman_admin.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="halaman_admin.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>
	<a href="logout.php">LOGOUT</a>
</body>
</html>