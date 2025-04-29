<?php if (isset($scripts) && is_array($scripts)) : ?>
    <?php foreach ($scripts as $script) : ?>
        <script 
            src="<?php echo base_url($script); ?>" 
            type="text/javascript" 
            <?php echo strpos($script, 'cdn.min.js') !== false ? 'defer' : ''; ?>>
        </script>
    <?php endforeach; ?>
<?php endif; ?>
<script src="<?php echo base_url('dist/js/partials/darkmode.js'); ?>" defer></script>