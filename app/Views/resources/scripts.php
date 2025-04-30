<?php 

/* 
 * This file loads all JavaScript files and executes the scripts.
 * It is included in the main layout file.
 * The manually defined scripts are the global ones.
 * The scripts are loaded in the order they are defined.
 * The ones in the array are dymamically loaded in the order they are defined.
 */


?>


<script src="<?php echo base_url('dist/modules/js/cdn.min.js'); ?>" defer></script>
<script src="<?php echo base_url('dist/modules/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/modules/js/floating-ui.core.umd.min.js'); ?>" defer></script>
<script src="<?php echo base_url('dist/modules/js/floating-ui.dom.umd.min.js'); ?>" defer></script>
<script src="<?php echo base_url('dist/js/default.min.js'); ?>" defer></script>
<script src="<?php echo base_url('dist/js/global.min.js'); ?>" defer></script>
<script src="<?php echo base_url('dist/js/partials/darkmode.min.js'); ?>" defer></script>


<?php if (isset($scripts) && is_array($scripts)) : ?>
    <?php foreach ($scripts as $script) : ?>
        <script 
            src="<?php echo base_url($script); ?>" 
            type="text/javascript">
        </script>
    <?php endforeach; ?>
<?php endif; ?>
