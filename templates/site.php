<div id="header">
    <?php if (isset($_SESSION['uid'])): ?>
    <div id='user-bar'>sei loggato come:<br/>
    <?php echo $_SESSION['user_name'] . " - " . $_SESSION['type'] ?><br/>
    <a href='users.php?a=logout'>logout</a></div>
    <?php endif; ?>
    
</div>
<div id="menu-bar">
    <ul>
        <li><a href='/'>Home</a></li>
        <li>How it works</li>
        <li>
            <?php if(isset($_SESSION['uid'])): ?>
            <a href='/users.php?tables=tables'>User's page</a>
            <?php else: ?>
            <a href='/users.php?tab=login'>Login</a>/<a href='/users.php?tab=register'>Register</a>
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