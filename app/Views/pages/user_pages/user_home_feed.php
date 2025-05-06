<!-- filepath: c:\xampp_8\htdocs\social-forum-systems\app\Views\pages\user_pages\user_home_feed.php -->
<?php echo $this->extend('pages/user_home_page_template'); ?>
<?php echo $this->section('content'); ?>
<script src="<?php echo base_url('dist/js/pages/user_pages/user_home_feed.min.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('dist/css/pages/user_pages/user_home_feed.min.css') ?>">
<!-- filepath: c:\xampp_8\htdocs\social-forum-systems\app\Views\pages\user_pages\user_home_feed.php -->
<div class="user_home_feed m-6" id="user_home_feed" x-data="userHomeFeed" x-init="init()">
    <!-- Create Post -->
    <div class="box">
        <div class="field has-addons">
            <div class="control is-expanded">
                <input class="input" type="text" placeholder="What stories do we have in mind?" x-model="newPostContent" id="new_post_content">
            </div>
            <div class="control">
                <button class="button is-info" @click="addPost">
                    Post
                </button>
            </div>
        </div>

        <!-- Additional Icons for Photos, Videos, and Location -->
        <div class="level is-mobile mt-3">
            <div class="level-item has-text-centered">
                <span class="icon-text" style="cursor: pointer;">
                    <span class="icon">
                        <i class="fas fa-image has-text-success"></i>
                    </span>
                    <span>Photo</span>
                </span>
            </div>
            <div class="level-item has-text-centered">
                <span class="icon-text" style="cursor: pointer;">
                    <span class="icon">
                        <i class="fas fa-video has-text-danger"></i>
                    </span>
                    <span>Video</span>
                </span>
            </div>
            <div class="level-item has-text-centered">
                <span class="icon-text" style="cursor: pointer;">
                    <span class="icon">
                        <i class="fas fa-map-marker-alt has-text-primary"></i>
                    </span>
                    <span>Location</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Posts -->
    <template x-for="post in posts" :key="post.id">
        <div class="post box" :data-id="post.id" style="position: relative;">
            <div class="post-header">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-48x48">
                            <img class="profile-pic" src="https://placehold.co/48" alt="Profile picture">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-5" x-text="post.author"></p>
                        <p class="subtitle is-7" x-text="post.timestamp"></p>
                    </div>
                </div>
            </div>
            <div class="post-content m-3">
                <p x-text="post.content"></p>
            </div>
            <div class="post-actions">
                <div class="level is-mobile">
                    <div class="level-left">
                        <!-- Like Button with Floating Reactions -->
                        <div class="level-item" x-data="{ showReactions: false }" @mouseleave="showReactions = false">
                            <span class="icon-text" id="reaction-icon" @mouseenter="showReactions = true" style="cursor: pointer;">
                                <span class="icon">
                                    <!-- Dynamically display the reaction icon -->
                                    <i :class="getReactionIcon(post.reaction)"></i>
                                </span>
                                <!-- Dynamically display the reaction text -->
                                <span x-text="getReactionText(post.reaction)"></span>
                            </span>

                            <!-- Floating Reactions -->
                            <div 
                                x-show="showReactions" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-75"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-75"
                                class="floating-reactions box p-2"
                                style="position: absolute; z-index: 1000; display: flex; gap: 1.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); top: 8rem; left: 0;"
                            >
                                <span @click="react(post, 'like')" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="fas fa-thumbs-up has-text-info"></i>
                                </span>
                                <span @click="react(post, 'love')" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="fas fa-heart has-text-danger"></i>
                                </span>
                                <span @click="react(post, 'laugh')" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="fas fa-laugh has-text-warning"></i>
                                </span>
                                <span @click="react(post, 'wow')" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="fas fa-surprise has-text-primary"></i>
                                </span>
                                <span @click="react(post, 'sad')" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="fas fa-sad-tear has-text-grey"></i>
                                </span>
                                <span @click="react(post, 'angry')" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="fas fa-angry has-text-danger"></i>
                                </span>
                            </div>
                        </div>

                        <div class="level-item">
                            <span class="icon-text">
                                <span class="icon">
                                    <i class="far fa-comment"></i>
                                </span>
                                <span>Comment</span>
                            </span>
                        </div>
                        <div class="level-item">
                            <span class="icon-text">
                                <span class="icon">
                                    <i class="fas fa-share"></i>
                                </span>
                                <span>Share</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
<?php echo $this->endSection(); ?>