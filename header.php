<?php
session_start();
?>
<header>
    <div class="header-container">
        <!-- Left side: Logo and Navigation -->
        <div class="logo-nav">
            <img src="img/logo-big-v4.png" alt="Developer Land" height="75" width="190" class="logo">
            <nav>
                <ul>
                    <li><a href="<?php $base_url ?>index.php">Home</a></li>
                </ul>
            </nav>
        </div>

        <div class="login">
            <a href="login.php" class="login-btn">Login</a>
        </div>
        
    </div>
    <pre style="border: 1px dashed lightgrey; padding: 10px; font-size: 20px;"><?php 
        if(isset($_SESSION)) print_r($_SESSION);
        else echo '$_SESSION bestaat niet';
        ?></pre>
</header>