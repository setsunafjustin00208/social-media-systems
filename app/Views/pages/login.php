<?php echo $this->extend('default'); ?>
<?php echo $this->section('content'); ?>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                        <form action="" class="box is-justify-content-center login-box" id="login">
                            <div class="field">
                                <label for="" class="label">Email</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input type="email" id="email-address" placeholder="e.g. bobsmith@gmail.com" class="input" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fa" id="email-icon-right"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="" class="label">Password</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input type="password" id="password" placeholder="*******" class="input" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fa" id="password-icon-right"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="" class="checkbox ">
                                        <input type="checkbox" id="remember-me">
                                        <span class="has-text-light remember-me-label" id="remember-me-label">
                                            Remember me
                                        </span>
                                        
                                    </label>
                                </div>
                                <div class="field">
                                    <button class="button is-success" id="login-button">
                                    Login
                                    </button>
                                </div>
                                <div class="field">
                                    <p class="help" id="error-message"></p>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo $this->endSection(); ?>
