<section>
    <div class="container">
        <h2 class="mb-5">
            Laporan (<?php echo $count ?>)
        </h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Hasil</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($reports as $report) : ?>
                    <tr>
                        <th><?php echo $i ?></th>
                        <td><?php echo $report['result'] ?></td>
                        <td><?php echo $report['date_created'] ?></td>
                        <td><a href="<?php echo site_url(); ?>report/generate_pdf?id=<?php echo $report['report_id'] ?>"><span class="badge badge-pill badge-info">Cetak</span></a></td>
                    </tr>
                <?php
                    $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</section>