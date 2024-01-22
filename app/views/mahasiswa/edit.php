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
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url; ?>/mahasiswa/updateMahasiswa" method="POST">
                <input type="hidden" name="id" value="<?= $data['mahasiswa']['MahasiswaID']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama mahasiswa..." name="nama" value="<?= $data['mahasiswa']['Nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Masukkan alamat mahasiswa..." name="alamat" value="<?= $data['mahasiswa']['Alamat']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="<?= $data['mahasiswa']['TanggalLahir']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                            <option value="Laki-Laki" <?php if ($data['mahasiswa']['JenisKelamin'] == 'Laki-Laki') {
                                                            echo "selected";
                                                        } ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($data['mahasiswa']['JenisKelamin'] == 'Perempuan') {
                                                            echo "selected";
                                                        } ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select class="form-control" name="program_studi_id">
                            <option value="">Pilih</option>
                            <?php foreach ($data['program_studi'] as $row) : ?>
                                <option value="<?= $row['ProgramStudiID']; ?>" <?php if ($data['mahasiswa']['ProgramStudiID'] == $row['ProgramStudiID']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $row['NamaProgram']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kontak Darurat</label>
                        <input type="text" class="form-control" placeholder="Masukkan kontak darurat mahasiswa..." name="kontak_darurat" value="<?= $data['mahasiswa']['KontakDarurat']; ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->