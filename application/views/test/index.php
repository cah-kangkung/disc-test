<section>
    <div class="container">
        <div class="test-header">
            <h2 class="heading">Test DISC Online</h2>
            <q class="text">Pilih satu diantara 4 pilihan yang ada tiap barisnya. Pastikan opsi yang anda pilih benar-benar menggambarkan kepribadian anda.</q>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="test-questions">
                    <form action="<?php echo site_url(); ?>test/submit_test" method="post">
                        <div class="row">

                            <?php $i = 1; ?>
                            <?php foreach ($questions as $question) : ?>
                                <div class="col-lg-6 mb-2">
                                    <div class="card shadow-sm bg-secondary mb-3">
                                        <div class="card-body">
                                            <div class="form-group question">
                                                <p class="card-text">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="option<?php echo $i ?>Influence" name="question<?php echo $i; ?>" class="custom-control-input" value="i" checked>
                                                        <label class="custom-control-label" for="option<?php echo $i ?>Influence"><?php echo $question['influence'] ?></label>
                                                    </div>
                                                </p>
                                                <p class="card-text">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="option<?php echo $i ?>Dominance" name="question<?php echo $i; ?>" class="custom-control-input" value="d">
                                                        <label class="custom-control-label" for="option<?php echo $i ?>Dominance"><?php echo $question['dominance'] ?></label>
                                                    </div>
                                                </p>
                                                <p class="card-text">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="option<?php echo $i ?>Compliance" name="question<?php echo $i; ?>" class="custom-control-input" value="c">
                                                        <label class="custom-control-label" for="option<?php echo $i ?>Compliance"><?php echo $question['compliance'] ?></label>
                                                    </div>
                                                </p>
                                                <p class="card-text">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="option<?php echo $i ?>Steadiness" name="question<?php echo $i; ?>" class="custom-control-input" value="s">
                                                        <label class="custom-control-label" for="option<?php echo $i ?>Steadiness"><?php echo $question['steadiness'] ?></label>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            <div class="col-12 mt-4 d-flex mb-4">
                                <button type="submit" class="btn btn-primary" id="btnSubmit" onclick="return confirm('Yakin ingin submit hasil?')" style="width: 50%; margin: 0 auto;">Submit Hasil</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card card-timer text-white bg-warning mb-3">
                    <div class=" card-body align-center">
                        <p class="card-text">Test sedang berjalan</p>
                        <p class="card-text mb-0">Sisa Waktu:</p>
                        <p class="card-text test-timer" id="timer"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>