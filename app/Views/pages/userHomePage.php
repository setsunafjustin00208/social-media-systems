<?php echo $this->extend('default'); ?>
<?php echo $this->section('content'); ?>
    <?php echo $this->include('components/navbar'); ?>
        <div class="columns is-gapless">
            <div class="column is-7-mobile is-2-desktop is-5-tablet is-2-widescreen is-hidden-touch sidebar">
                <?php echo $this->include('components/sidebar'); ?>
            </div>
            <div id="main-content" class="column has-background-white-ter">
                <section class="container">
                    <?php echo $this->renderSection('content'); ?>
                </section>
            </div>
        </div>
    <?php echo $this->include('components/footer'); ?>
<?php echo $this->endSection(); ?>