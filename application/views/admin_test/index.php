<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Soal</h1>
        <a href="<?php echo site_url(); ?>admin_test/add_question" class="btn btn-primary shadow-sm">Tambah Soal</a>
    </div>

    <?php if ($this->session->flashdata('danger_alert')) : ?>
        <div class="alert alert-dismissible alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('danger_alert'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success_alert')) : ?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success_alert'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Soal</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Influence</th>
                            <th>Dominant</th>
                            <th>Correct</th>
                            <th>Stable</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($questions as $question) : ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $question['influence'] ?></td>
                                <td><?php echo $question['dominant'] ?></td>
                                <td><?php echo $question['correct'] ?></td>
                                <td><?php echo $question['stable'] ?></td>
                                <td>
                                    <a href="<?php echo site_url(); ?>admin_test/edit_question/<?php echo $question['question_id'] ?>"><span class="badge badge-success">Edit</span></a>
                                    <a href="<?php echo site_url(); ?>admin_test/delete_question/<?php echo $question['question_id'] ?>"><span class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</span></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->