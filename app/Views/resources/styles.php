<?php if (isset($styles) && is_array($styles)) : ?>
        <?php foreach ($styles as $style) : ?>
            <link rel="stylesheet" href="<?php echo base_url($style); ?>">
        <?php endforeach; ?>
<?php endif; ?>