<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script src="<?= base_url() ?>assets/js/tabler.min.js"></script>
<script src="<?= base_url() ?>assets/js/demo.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script src="<?= base_url() ?>assets/js/script.js?v<?= fileatime('assets/js/script.js') ?>"></script>

<?php if ($this->session->get_flash_keys()) { ?>
    <script>
        <?php foreach ($this->session->get_flash_keys() as $flashKey) { ?>
            notyf.open({
                icon: false,
                type: '<?= $flashKey ?>',
                message: '<?= strip_tags($this->session->flashdata($flashKey)); ?>'
            })
        <?php } ?>
    </script>
<?php } ?>