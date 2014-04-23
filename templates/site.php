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
        <li><a href='/users.php?a=login'>Login</a>/<a href='/users.php?a=register'>Register</a></li>
        <li>Contact us</li>
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