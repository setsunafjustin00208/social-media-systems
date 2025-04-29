<!-- filepath: c:\xampp_8\htdocs\social-forum-systems\app\Views\pages\userHomePage.php -->
<?php echo $this->extend('default'); ?>
<?php echo $this->section('content'); ?>
    <?php echo $this->include('components/navbar'); ?>
        <div class="columns is-gapless" x-data="{ isChatVisible: true }">
            <div class="column is-7-mobile is-2-desktop is-5-tablet is-2-widescreen is-hidden-touch sidebar">
                <?php echo $this->include('components/sidebar'); ?>
            </div>
            <div id="main-content" class="column has-background-white-ter">
                <section class="container">
                    <?php echo $this->renderSection('content'); ?>
                </section>
            </div>

            <!-- Chat Column -->
            <div 
                class="column is-7-mobile is-2-desktop is-5-tablet is-2-widescreen is-hidden-touch chat-column has-background-grey-darker" 
                x-show="isChatVisible" 
                x-transition
            >
                <!-- Toggle Button to Hide Column -->
                <button 
                    class="button is-small mb-3 hide-chat-button" 
                    @click="isChatVisible = false"
                >
                    <span class="icon">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </button>

                <!-- Chat Component -->
                <?php echo $this->include('components/chat-component'); ?>
            </div>

            <!-- Button to Reappear the Chat Column -->
            <button 
                class="button is-small show-chat-button" 
                x-show="!isChatVisible" 
                @click="isChatVisible = true" 
                x-transition
                style="position: absolute; top: 4.12rem; right: .25rem;"
            >
                <span class="icon">
                    <i class="fas fa-chevron-left"></i>
                </span>
            </button>
        </div>
    <?php echo $this->include('components/footer'); ?>
<?php echo $this->endSection(); ?>