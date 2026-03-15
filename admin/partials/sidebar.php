<?php
$admin_current = basename($_SERVER['PHP_SELF'], '.php');
?>
<button class="admin-mobile-toggle" aria-label="Toggle Menu" id="admin-mobile-toggle">
  ☰
</button>
<div class="admin-sidebar-overlay" id="admin-sidebar-overlay"></div>
<aside class="admin-sidebar" id="admin-sidebar">
  <div class="admin-sidebar-logo">
    <img src="../css/img/v4d.png" alt="v4d" class="admin-sidebar-logo-img">
    <span class="sidebar-text">v4d Admin</span>
  </div>

  <nav class="admin-sidebar-nav">
    <a href="index.php" class="sidebar-link <?= $admin_current === 'index' ? 'active' : '' ?>">
      <span class="sidebar-icon">📊</span> <span class="sidebar-text">Dashboard</span>
    </a>
    <a href="players.php" class="sidebar-link <?= $admin_current === 'players' ? 'active' : '' ?>">
      <span class="sidebar-icon">👥</span> <span class="sidebar-text">Players</span>
    </a>
    <a href="tournaments.php" class="sidebar-link <?= $admin_current === 'tournaments' ? 'active' : '' ?>">
      <span class="sidebar-icon">🏆</span> <span class="sidebar-text">Tournaments</span>
    </a>
    <a href="stats.php" class="sidebar-link <?= $admin_current === 'stats' ? 'active' : '' ?>">
      <span class="sidebar-icon">✏️</span> <span class="sidebar-text">Update Stats</span>
    </a>
    <div class="sidebar-divider"></div>
    <a href="../index.php" target="_blank" class="sidebar-link">
      <span class="sidebar-icon">🌐</span> <span class="sidebar-text">View Site</span>
    </a>
    <a href="logout.php" class="sidebar-link sidebar-logout">
      <span class="sidebar-icon">🚪</span> <span class="sidebar-text">Logout</span>
    </a>
  </nav>
</aside>
