<html>
    <head>
        <?php echo $css; ?>
        <?php echo $js; ?>
    </head>
    <body>
        
        <?php
        require_once $outer_template;
        //echo $template;
        ?>
        
        <div id='debug'><?php echo $debug; ?></div>
    </body>

</html>