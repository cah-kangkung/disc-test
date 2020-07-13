<footer>
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