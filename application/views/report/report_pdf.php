<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tes DISC</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            letter-spacing: 1px;
            line-height: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        .container {
            max-width: 90%;
            margin: 30px auto;
        }

        .user-info {
            font-size: 18px;
            background-color: blanchedalmond;
            border-radius: 10px;
            padding: 30px;
            width: 50%;
            margin: 40% auto 0 auto;
        }

        .user-info table {
            width: 100%;
        }

        .report .heading {
            text-align: center;
        }

        .content .section {
            margin-bottom: 0;
        }

        .content .section span {
            margin-left: 15px;
        }

        .content .text {
            font-size: 15px;
            text-align: justify;
            margin-top: 5px;
            margin-left: 40px;
        }
    </style>
</head>

<body>
    <div class="cover">
        <div class="user-info">
            <table class="">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>: <?php echo $user_data['full_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>: <?php echo $user_data['birth'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Tes</td>
                        <td>: <?php echo $report['date_created'] ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

    <?php if ($report['result'] == 'influence') : ?>
        <div class="report page-break">
            <div class="container">
                <div class="heading">
                    <h2>URAIAN HASIL TES DISC</h2>
                    <h3>Tipe Kepribadian I (Influence)</h3>
                </div>
                <br>
                <div class="content">
                    <div class="section-wrapper">
                        <h4 class="section">A. <span>Karakteristik Umum</span></h4>
                        <p class="text">Orang-orang yang berkepribadian influence (I) atau yang biasa dikenal sebagai seorang yang berpengaruh, biasanya memiliki karakteristik umum seperti, antusias, memiliki kepercayaan diri yang tinggi, selalu optimis, banyak bicara, impulsive, emosional dan persuasif (mudah mempengaruhi orang lain).</p>
                        <p class="text">Orang-orang seperti ini biasanya sangat handal dalam memecahkan masalah, selalu memberi semangat yang besar kepada orang-orang di sekitarnya, memotivasi orang lain untuk mencapai tujuan, memiliki humor yang positif dan baik, hebat dalam bernegosiasi terutama saat terjadi konflik, sehingga mereka berperan aktif dalam menciptakan perdamaian.</p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">B. <span>Kemungkinan Kelemahan</span></h4>
                        <p class="text">Kekurangan dari tipe ini, mereka adalah orang-orang yang lebih mementingkan popularitas daripada hasil yang nyata, tidak suka memperhatikan segala sesuatu secara detail, ekspresif (gerakan tubuh dan ekspresi wajah yang diberikan sangat berlebihan) dan cenderung hanya ingin mendengarkan sesuatu yang membuat mereka nyaman dan bahagia. Apabila yang didengarkan adalah hal negatif bagi mereka, maka mereka akan mengabaikannya begitu saja.</p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">C. <span>Ketakutan Terbesar</span></h4>
                        <p class="text">Mereka sangat takut dengan sebuah penolakan, karena mereka menganggap semua orang akan menerima dan menyukai mereka.</p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">D. <span>Hal yang Dapat Memotivasi</span></h4>
                        <p class="text">Tentunya, mereka akan sangat termotivasi jika ada yang memuji dan menyanjung diri mereka, popularitas dan sebuah penerimaan adalah harta karun yang berharga bagi para influencer. Mereka sangat menyukai lingkungan yang ramah, bebas dari segala aturan dan regulasi yang menyesakkan dan mempersilahkan orang lain untuk memperhatikan sesuatu secara rinci.</p>
                    </div>

                </div>
            </div>
        </div>
    <?php elseif ($report['result'] == 'dominance') : ?>
        <div class="report page-break">
            <div class="container">
                <div class="heading">
                    <h2>URAIAN HASIL TES DISC</h2>
                    <h3>Tipe Kepribadian D (Dominance)</h3>
                </div>
                <br>
                <div class="content">
                    <div class="section-wrapper">
                        <h4 class="section">A. <span>Karakteristik Umum</span></h4>
                        <p class="text">Orang-orang yang memiliki sikap dominan, mereka cenderung mengutarakan segala hal secara langsung, mereka memiliki pengaruh yang kuat untuk menentukan sesuatu. Tidak hanya itu, mereka memiliki kekuatan ego yang tinggi. Meskipun begitu, mereka adalah pemecah masalah yang ulung, berani mengambil risiko, dan pemula yang mandiri.</p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">B. <span>Nilai Untuk Tim</span></h4>
                        <p class="text">Orang yang dominan adalah seseorang yang dapat mengambil kesimpulan, mereka sangat menghargai segala sesuatu yang selesai dengan tepat waktu, menantang status quo dan orang-orang yang sangat berinovatif. </p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">C. <span>Kemungkinan Kelemahan</span></h4>
                        <p class="text">Memiliki sikap yang terlalu sering berargumen, terlalu melebihi otoritas yang mereka miliki, sangat tidak menyukai rutinitas, dan terlalu menyusahkan diri dengan melakukan banyak hal secara sekaligus.</p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">D. <span>Ketakutan Terbesar</span></h4>
                        <p class="text">Mereka sangat takut untuk dimanfaatkan.</p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">E. <span>Hal yang Dapat Memotivasi</span></h4>
                        <p class="text">Sangat termotivasi oleh tantangan baru, sangat suka menghadapi sesuatu yang terdiri dari kekuasaan dan wewenang untuk mengambil risiko, serta membuat keputusan</p>
                    </div>

                </div>
            </div>
        </div>
    <?php elseif ($report['result'] == 'compliance') : ?>
        <div class="report page-break">
            <div class="container">
                <div class="heading">
                    <h2>URAIAN HASIL TES DISC</h2>
                    <h3>Tipe Kepribadian C (Compliance)</h3>
                </div>
                <br>
                <div class="content">
                    <div class="section-wrapper">
                        <h4 class="section">A. <span>Karakteristik Umum</span></h4>
                        <p class="text">Secara umum, mereka adalah orang-orang yang sangat akurat dan seorang yang analitis. Itulah mengapa mereka sangat cermat dan teliti. Segalanya harus berdasarkan fakta dan tepat pada sasaran. Sehingga, mereka memiliki standar yang tinggi dan sangat sistematis. </p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">B. <span>Nilai Untuk Tim</span></h4>
                        <p class="text">Karena sikapnya yang sangat analitis, mereka memiliki ketelitian yang sangat mendalam pada semua kegiatan. Suka mendefinisikan situasi, mengumpulkan data, mengkritik dan menguji kebenaran dari informasi-informasi yang didapatkan. </p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">C. <span>Kemungkinan Kelemahan</span></h4>
                        <p class="text">Kekurangan dari mereka adalah memerlukan batasan yang jelas dari setiap tindakan yang diperbuat, terlalu terikat oleh prosedur dan metode yang ada, sering mandek dalam hal-hal yang rinci, tidak suka mengungkapkan perasaan secara verbal, tidak suka berdebat. </p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">D. <span>Ketakutan Terbesar</span></h4>
                        <p class="text">Yang paling ditakutkan oleh mereka adalah kritik.</p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">E. <span>Hal yang Dapat Memotivasi</span></h4>
                        <p class="text">Mereka sangat termotivasi oleh standar kualitas yang tinggi, sangat menyukai interaksi sosial yang terbatas, mencintai tugas yang terperinci dan organisasi yang memiliki informasi-informasi yang logis. </p>
                    </div>

                </div>
            </div>
        </div>
    <?php elseif ($report['result'] == 'steadiness') : ?>
        <div class="report page-break">
            <div class="container">
                <div class="heading">
                    <h2>URAIAN HASIL TES DISC</h2>
                    <h3>Tipe Kepribadian S (Steadiness)</h3>
                </div>
                <br>
                <div class="content">
                    <div class="section-wrapper">
                        <h4 class="section">A. <span>Karakteristik Umum</span></h4>
                        <p class="text">Mereka yang memiliki kepribadian ini adalah seorang pendengar yang baik, pemain tim yang unggul, seorang yang posesif dan menenangkan. Mereka juga seseorang yang mudah untuk ditebak dan sangat ramah serta selalu berusaha memahami orang lain. </p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">B. <span>Nilai Untuk Tim</span></h4>
                        <p class="text">Nilai atau kelebihan yang mereka miliki adalah dapat diandalkan, seorang pekerja tim yang sangat setia, patuh terhadap pihak manajemen atau orang-orang yang memiliki otoritas, penyabar, seorang yang memiliki empati tinggi dan sangat handal dalam mendamaikan konflik.</p>
                    </div>

                    <div class="section-wrapper">
                        <h4 class="section">C. <span>Kemungkinan Kelemahan</span></h4>
                        <p class="text">Kekurangan mereka adalah suka menolak perubahan, sehingga membutuhkan waktu yang cukup lama untuk menyesuaikan diri dengan lingkungan baru. Ups! Hati-hati karena mereka seorang yang pendendam, peka terhadap kritik dan kesulitan untuk menetapkan prioritas.</p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">D. <span>Ketakutan Terbesar</span></h4>
                        <p class="text">Mereka takut kehilangan rasa aman. </p>
                    </div>
                    <div class="section-wrapper">
                        <h4 class="section">E. <span>Hal yang Dapat Memotivasi</span></h4>
                        <p class="text">Pengakuan atas pengabdian dan tanggung jawab. Keamanan dan keselamatan. Tidak ada perubahan mendadak dalam prosedur atau gaya hidup. Aktivitas yang bisa diselesaikan.</p>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

</body>

</html>