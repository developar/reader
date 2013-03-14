<html>
    <head>
        <title>Reader</title>
    </head>
    <body>
        <?php 
        $subs = file('Takeout/subscriptions.xml');
        print_r($subs);
        ?>
    </body>
</html>