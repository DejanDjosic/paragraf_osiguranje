<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <a href='index.php' class="navbar-brand">Putno osiguranje</a>
    <ul class='navbar-nav ml-auto' >
        <?php if(!isset($_SESSION['id_sesije'])): ?>
            <li class="nav-item">
                <a class="nav-link" href='login.view.php'>Ulogujte se</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='registracija.view.php'>Registrujte se</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <p class="navbar-brand">Dobrodošli, <?php echo $_SESSION['ime']; ?></p>
            </li>
            <li class='nav-item'>
				<a class='nav-link' href='profil.php'>Moje polise</a>
			</li>
            <?php if(isset($_SESSION['id_sesije']))if($_SESSION['id_sesije']==='admin'):?>
            <li class='nav-item'>
				<a class='nav-link' href='admin_panel.php'>Admin panel</a>
			</li>
            <?php endif?>
			<li class='nav-item'>
				<a class='nav-link' href='logout.php'>Odjavite se</a>
			</li>
        <?php endif; ?>
    </ul>
</nav>
