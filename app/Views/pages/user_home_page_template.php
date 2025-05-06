<?php echo $this->extend('default'); ?>
<?php echo $this->section('content'); ?>
    <?php echo $this->include('components/navbar'); ?>
        <div class="columns is-gapless" x-data="{ 
            isSidebarSmallVisible: localStorage.getItem('isSidebarSmallVisible') === 'true', 
            isChatVisible: true 
        }" 
        x-init="
            $watch('isSidebarSmallVisible', value => localStorage.setItem('isSidebarSmallVisible', value))
        ">
            <!-- Sidebar -->
            <div 
                class="column is-7-mobile is-5-tablet is-hidden-touch sidebar" 
                :class="isSidebarSmallVisible 
                    ? 'is-1-widescreen is-1-desktop' 
                    : 'is-2-widescreen is-2-desktop'"
                    x-transition
            >
                <div class="has-text-right">
                    <button 
                        class="button is-small toggle-sidebar-button has-text-right" 
                        @click="isSidebarSmallVisible = !isSidebarSmallVisible" 
                        x-transition
                    >
                        <span class="icon" x-transition>
                            <i class="fas" :class="isSidebarSmallVisible ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
                        </span>
                    </button>
                </div>
                <!-- Toggle Button for Sidebar -->

                <template x-if="!isSidebarSmallVisible" x-transition>
                    <?php echo $this->include('components/sidebar'); ?>
                </template>
                <template x-if="isSidebarSmallVisible" x-transition>
                    <?php echo $this->include('components/sidebar-small'); ?>
                </template>
            </div>

            <!-- Main Content -->
            <div id="main-content" class="column has-background-white-ter">
                <section class="container">
                    <?php echo $this->renderSection('content'); ?>
                </section>
            </div>

            <!-- Chat Column -->
            <div 
                class="column is-7-mobile is-3-desktop is-5-tablet is-3-widescreen is-hidden-touch chat-column has-background-grey-darker" 
                x-show="isChatVisible" 
                x-transition
            >
                <!-- Toggle Button to Hide Chat -->
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
                style="position: absolute; top: 4.12rem; right: .25rem; z-index: 10;"
            >
                <span class="icon">
                    <i class="fas fa-chevron-left"></i>
                </span>
            </button>
        </div>
    <?php echo $this->include('components/footer'); ?>
<?php echo $this->endSection(); ?>