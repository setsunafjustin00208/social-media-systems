<?php if (isset($scripts) && is_array($scripts)) : ?>
    <?php foreach ($scripts as $script) : ?>
        <script src="<?php echo base_url($script); ?>" type="text/javascript"></script>
    <?php endforeach; ?>
<?php endif; ?>