<aside class="menu p-3 has-text-centered" x-transition>
<script src="<?php echo base_url('dist/js/components/sidebar-small.min.js') ?>"></script>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg far fa-user-circle"></i>
    </span>
    Personal
  </p>
  
  <ul class="menu-list sidebar-small">
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'home') ? 'is-active' : '' ?>" data-tooltip="Home">
            <span class="icon is-large">
                <i class="fas fa-lg fa-home"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'characters') ? 'is-active' : '' ?>" data-tooltip="Your Characters">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users-between-lines"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'lores') ? 'is-active' : '' ?>" data-tooltip="Your Lores">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-journal-whills"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'world-building') ? 'is-active' : '' ?>" data-tooltip="Your World Building">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-atlas"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'vehicles') ? 'is-active' : '' ?>" data-tooltip="Your Vehicles">
            <span class="icon is-large">
                <i class="fas fa-car-side"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'npcs') ? 'is-active' : '' ?>" data-tooltip="Your NPCs">
            <span class="icon is-large">
                <i class="fa-lg fab fa-grunt"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'entries') ? 'is-active' : '' ?>" data-tooltip="Your Entries">
            <span class="icon is-large">
                <i class="fa-lg fas fa-notes-medical"></i>
            </span>
        </a>
    </li>
  </ul>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg fas fa-dice"></i>
    </span>
    Roleplay
  </p>
  <ul class="menu-list sidebar-small">
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'events') ? 'is-active' : '' ?>" data-tooltip="Events">
            <span class="icon is-large">
                <i class="fas fa-lg fa-calendar-days"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'factions') ? 'is-active' : '' ?>" data-tooltip="Factions">
            <span class="icon is-large">
                <i class="fas fa-lg fa-jedi"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'arcs') ? 'is-active' : '' ?>" data-tooltip="Arcs">
            <span class="icon is-large">
                <i class="fab fa-lg fa-pied-piper-alt"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'plots') ? 'is-active' : '' ?>" data-tooltip="Plots">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-open"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'dimensions') ? 'is-active' : '' ?>" data-tooltip="Dimensions and Worlds">
            <span class="icon is-large">
                <i class="fas fa-lg fa-globe"></i>
            </span>
        </a>
    </li>
  </ul>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg fab fa-black-tie"></i>
    </span>
    Admin
  </p>
  <ul class="menu-list sidebar-small">
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-users') ? 'is-active' : '' ?>" data-tooltip="Manage Users">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users-rays"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-characters') ? 'is-active' : '' ?>" data-tooltip="Manage Characters">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users line"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-factions') ? 'is-active' : '' ?>" data-tooltip="Manage Factions">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users-rectangle"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-entries') ? 'is-active' : '' ?>" data-tooltip="Manage Entries">
            <span class="icon is-large">
                <i class="fas fa-lg fa-keyboard"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-lore') ? 'is-active' : '' ?>" data-tooltip="Manage Lore">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-bookmark"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-world-building') ? 'is-active' : '' ?>" data-tooltip="Manage World Building">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-plots-arcs') ? 'is-active' : '' ?>" data-tooltip="Manage Plots & Arcs">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-quran"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'monitor-activities') ? 'is-active' : '' ?>" data-tooltip="Monitor Activities">
            <span class="icon is-large">
                <i class="fas fa-lg fa-chart-column"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'suggestions-feedback') ? 'is-active' : '' ?>" data-tooltip="Suggestions & Feedback">
            <span class="icon is-large">
                <i class="fas fa-lg fa-envelope-open-text"></i>
            </span>
        </a>
    </li>
  </ul>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg fas fa-user-tie"></i>
    </span>
    Spr Admin
  </p>
  <ul class="menu-list sidebar-small">
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-admins') ? 'is-active' : '' ?>" data-tooltip="Manage Admins">
            <span class="icon is-large">
                <i class="fas fa-lg fa-chart-column"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'manage-ads') ? 'is-active' : '' ?>" data-tooltip="Manage Ads">
            <span class="icon is-large">
                <i class="fa-lg fab fa-adversal"></i>
            </span>
        </a>
    </li>
    <li>
        <a class="has-text-centered sidebar-small-item <?= ($activePage === 'statistics-reports') ? 'is-active' : '' ?>" data-tooltip="Statistics & Reports">
            <span class="icon is-large">
                <i class="fa-lg fas fa-chart-pie"></i>
            </span>
        </a>
    </li>
  </ul>
</aside>