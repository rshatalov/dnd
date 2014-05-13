<div id="header">
    <?php if (isset($_SESSION['email'])): ?>
    <div id='user-bar'>sei loggato come:<br/>
    <?php echo $_SESSION['email'] . " - " . $_SESSION['type'] ?><br/>
    <a href='users.php?a=logout'>logout</a></div>
    <?php endif; ?>
    
</div>
<div id="menu-bar">
    <ul>
        <li><a href='/'>Home</a></li>
        <li>How it works</li>
        <li>
            <?php if(isset($_SESSION['email'])): ?>
            <a href='/users.php?a=tables'>User's page</a>
            <?php else: ?>
            <a href='/users.php?a=login'>Login</a>/<a href='/users.php?a=register'>Register</a>
            <?php endif;?>
        </li>
        <li>Contact us</li>
        <li><a href='/admin.php'>Admin</a></li>
    </ul>
</div>

<div id="content">
        <?php
        require_once $inner_template;
        ?>
</div>

<div id="ads">
</div>

<div id="footer"></div>