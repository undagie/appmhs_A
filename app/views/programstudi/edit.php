<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Program Studi</h1>
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
            <form role="form" action="<?= base_url; ?>/programstudi/updateProgramStudi" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['program_studi']['ProgramStudiID']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Program Studi</label>
                        <input type="text" class="form-control" placeholder="masukkan nama program studi..." name="nama_program" value="<?= $data['program_studi']['NamaProgram']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Fakultas</label>
                        <select class="form-control" name="fakultas_id">
                            <?php foreach ($data['fakultas'] as $fakultas) : ?>
                                <option value="<?= $fakultas['FakultasID']; ?>" <?= $fakultas['FakultasID'] == $data['program_studi']['FakultasID'] ? 'selected' : ''; ?>><?= $fakultas['NamaFakultas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->