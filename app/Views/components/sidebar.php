<!-- filepath: c:\xampp_8\htdocs\social-forum-systems\app\Views\components\sidebar.php -->
<aside class="menu p-3" x-transition>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg far fa-user-circle"></i>
    </span>
    Personal
  </p>
  
  <ul class="menu-list">
    <li>
        <a class="<?= ($activePage === 'home') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-home"></i>
            </span>
            Home
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'characters') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users-between-lines"></i>
            </span>
            Your Characters
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'lores') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-journal-whills"></i>
            </span>
            Your Lores
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'world-building') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-atlas"></i>
            </span>
            Your World Building
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'vehicles') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-car-side"></i>
            </span>
            Your Vehicles
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'npcs') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fa-lg fab fa-grunt"></i>
            </span>
            Your NPCs
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'entries') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fa-lg fas fa-notes-medical"></i>
            </span>
            Your Entries
        </a>
    </li>
  </ul>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg fas fa-dice"></i>
    </span>
    Roleplaying
  </p>
  <ul class="menu-list">
    <li>
        <a class="<?= ($activePage === 'events') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-calendar-days"></i>
            </span>
            Events
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'factions') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-jedi"></i>
            </span>
            Factions
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'arcs') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fab fa-lg fa-pied-piper-alt"></i>
            </span>
            Arcs
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'plots') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-open"></i>
            </span>
            Plots
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'dimensions') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-globe"></i>
            </span>
            Dimensions and Worlds
        </a>
    </li>
  </ul>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg fab fa-black-tie"></i>
    </span>
    Administration
  </p>
  <ul class="menu-list">
    <li>
        <a class="<?= ($activePage === 'manage-users') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users-rays"></i>
            </span>
            Manage Users
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-characters') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users line"></i>
            </span>
            Manage Characters
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-factions') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-users-rectangle"></i>
            </span>
            Manage Factions
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-entries') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-keyboard"></i>
            </span>
            Manage Entries
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-lore') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-bookmark"></i>
            </span>
            Manage Lore
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-world-building') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book"></i>
            </span>
            Manage World Building
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-plots-arcs') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-book-quran"></i>
            </span>
            Manage Plots & Arcs
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'monitor-activities') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-chart-column"></i>
            </span>
            Monitor Activities
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'suggestions-feedback') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-envelope-open-text"></i>
            </span>
            Suggestions & Feedback
        </a>
    </li>
  </ul>
  <p class="menu-label">
    <span class="icon">
        <i class="fa-lg fas fa-user-tie"></i>
    </span>
    Super Administration
  </p>
  <ul class="menu-list">
    <li>
        <a class="<?= ($activePage === 'manage-admins') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fas fa-lg fa-chart-column"></i>
            </span>
            Manage Admins
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'manage-ads') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fa-lg fab fa-adversal"></i>
            </span>
            Manage Ads
        </a>
    </li>
    <li>
        <a class="<?= ($activePage === 'statistics-reports') ? 'is-active' : '' ?>">
            <span class="icon is-large">
                <i class="fa-lg fas fa-chart-pie"></i>
            </span>
            Statistics & Reports
        </a>
    </li>
  </ul>
</aside>