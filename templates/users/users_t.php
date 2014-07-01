<div id='tabs'>
<div class="tab" id="login-tab">Login</div>
<div class="tab" id="register-tab">Register</div>
<div style="clear: both"></div>
</div>

<div class='tab-content' id="login-content">
    Login
    <form method='post' action='users.php'>
        <table>
            <tr><td>E-mail</td>
                <td>
                    <input type='text' name='email'></td></tr>
            <tr><td>Password</td>
                <td>
                    <input type='password' name='pswd'></td></tr>
            <tr><td></td>
                <td>
                    <input type='hidden' name='a' value='login'>
                    <input type='submit'></td></tr>
        </table>
    </form>
</div> <!-- login-content -->
<div class='tab-content' id="register-content">
    Register
        <form method='post' action='users.php'>
        <table>
            <tr><td>E-mail</td>
                <td>
                    <input type='text' name='email'></td></tr>
                        <tr><td>User name</td>
                <td>
                    <input type='text' name='user_name'></td></tr>
            <tr><td>Password</td>
                <td>
                    <input type='password' name='pswd'></td></tr>
                        <tr><td>DM</td>
                <td>
                    <input type='radio' name='type' value='dm'></td></tr>
                                    <tr><td>Player</td>
                <td>
                    <input type='radio' name='type' value='player'></td></tr>
            <tr><td></td>
                <td>
                    <input type='hidden' name='a' value='register'>
                    <input type='submit'></td></tr>
        </table>
    </form>
    
</div> <!-- register-content -->