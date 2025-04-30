<?php 

/* 
 * This file loads all CSS stylesheets and includes them in the layout.
 * The manually defined styles are the global ones.
 * The styles are loaded in the order they are defined.
 * The ones in the array are dynamically loaded in the order they are defined.
 */

?>

<!-- Static Styles -->
<link rel="stylesheet" href="<?php echo base_url('dist/modules/css/sweetalert2.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('dist/css/default.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('dist/css/global.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('dist/css/partials/darkmode.min.css'); ?>">

<!-- Dynamically Loaded Styles -->
<?php if (isset($styles) && is_array($styles)) : ?>
    <?php foreach ($styles as $style) : ?>
        <link rel="stylesheet" href="<?php echo base_url($style); ?>">
    <?php endforeach; ?>
<?php endif; ?>
