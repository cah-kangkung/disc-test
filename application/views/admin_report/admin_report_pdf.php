<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin</title>

    <style>
        html,
        body {
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-break {
            page-break-before: always;
        }

        .container {
            margin: 0 1em;
        }

        .heading {
            text-align: center;
            margin-bottom: 4em;
        }

        table {
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 2px 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="heading">
                <h1>Laporan Pembayaran Psikologi Star</h1>
            </div>
            <div class="content">
                <div class="info">
                    <p>Tanggal : <strong><?php echo $date['date_from']; ?></strong> sampai <strong><?php echo $date['date_to']; ?></strong></p>
                </div>
                <div class="table">
                    <table style="width: 100%;">
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Bank Pengirim</th>
                            <th>No. Rekening</th>
                            <th>Atas Nama</th>
                            <th>Bank Penerima</th>
                            <th>Tgl Pesan</th>
                            <th>Jumlah Pembayaran</th>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($payment_list as $payment) :  ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $payment['payment_id'] ?></td>
                                <td><?php echo $payment['bank'] ?></td>
                                <td><?php echo $payment['bank_account_number'] ?></td>
                                <td><?php echo $payment['bank_account_name'] ?></td>
                                <td><?php echo $payment['destination_bank'] ?></td>
                                <td>
                                    <?php
                                    $date = new DateTime($payment['date_created']);
                                    $date = $date->format('d-m-Y');
                                    echo $date;
                                    ?>
                                </td>
                                <td>Rp <?php echo $payment['total_amount'] / 1000 ?>,000</td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <p>Total Pembayaran = <strong><?php echo $count; ?></strong></p>
                <p>Total Pendapatan = <strong>Rp <?php echo $total_earning / 1000 ?>,000</strong></p>
            </div>
        </div>
    </section>

    <section class="page-break">
        <div class="container">
            <div class="heading">
                <h1>Laporan Pengguna Psikologi Star</h1>
            </div>
            <div class="content">
                <div class="table">
                    <table style="width: 100%;">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($user_list as $user) :  ?>
                            <?php if ($user['role_id'] == 1102) : ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $user['full_name'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['no_hp'] ?></td>
                                    <td><?php echo $user['birth'] ?></td>
                                    <td><?php echo $user['sex'] ?></td>
                                    <?php $i++; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <p>Total User = <strong><?php echo $i - 1; ?></strong></p>
            </div>
        </div>
    </section>
</body>

</html>