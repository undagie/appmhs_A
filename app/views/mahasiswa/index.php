<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $data['title']; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <?php
                Flasher::Message();
                ?>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title'] ?></h3>
                <div class="btn-group float-right">
                    <a href="<?= base_url; ?>/mahasiswa/tambah" class="btn float-right btn-xs btn btn-primary">Tambah Mahasiswa</a>
                    <a href="<?= base_url; ?>/mahasiswa/laporan" class="btn float-right btn-xs btn btn-info" target="_blank">Laporan Mahasiswa</a>
                    <a href="<?= base_url; ?>/mahasiswa/lihatlaporan" class="btn float-right btn-xs btn btn-warning" target="_blank">Lihat Laporan Mahasiswa</a>
                    <a href="<?= base_url; ?>/mahasiswa/laporanJumlahMahasiswa" class="btn float-right btn-xs btn btn-success" target="_blank">Lihat Mahasiswa Per Prodi</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Program Studi</th>
                            <th>Kontak Darurat</th>
                            <th style="width:150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['mahasiswa'] as $row) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row['Nama']; ?></td>
                                <td><?= $row['Alamat']; ?></td>
                                <td><?= date('d-m-Y', strtotime($row['TanggalLahir'])); ?></td>
                                <td><?= $row['JenisKelamin']; ?></td>
                                <td><?= $row['NamaProgram']; ?></td>
                                <td><?= $row['KontakDarurat']; ?></td>
                                <td>
                                    <a href="<?= base_url; ?>/mahasiswa/edit/<?= $row['MahasiswaID'] ?>" class="badge badge-info">Edit</a>
                                    <a href="<?= base_url; ?>/mahasiswa/hapus/<?= $row['MahasiswaID'] ?>" class="badge badge-danger" onclick="return confirm('Hapus data?');">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->