<!DOCTYPE html>
<html lang="en" class="theme-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->include('partials/meta'); ?>
    <?php echo $this->include('partials/structured-data'); ?>
    <?php echo $this->include('resources/global-variables'); ?>
    <?php echo $this->include('resources/styles'); ?>
    <?php echo $this->include('resources/scripts'); ?>
    <?php // echo $this->renderSection('resources/scripts', $scripts); ?>
    <title><?php echo $title?></title>
</head>
<body class="">
    <?php echo $this->renderSection('content'); ?>
    <?php echo $this->include('partials/darkmode'); ?>
</body>
</html>