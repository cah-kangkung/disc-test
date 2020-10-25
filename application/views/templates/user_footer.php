<footer>
    <div class="container">
        <div class="copyright">
            Hak Cipta &#9400; 2020 Psikologi Star
        </div>
        <div class="footer-list ml-auto">
            <a href="<?php echo site_url(); ?>home">Beranda</a>
            <a href="<?php echo site_url(); ?>disc">Disc</a>
            <a href="<?php echo site_url(); ?>test">Tes</a>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

<?php if ($this->uri->segment(1) == 'test') : ?>
    <script src="<?php echo base_url(); ?>assets/js/custom-timer.js"></script>
<?php endif; ?>

</body>

</html>