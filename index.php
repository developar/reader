<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Reader</title>
        <style>
            * {
                margin: 0px;
                padding: 0px;
            }
            div {
                display: block;
            }
            body {
                overflow: hidden;
                display: block;
            }
            div.top {
                top: 0px;
                height: 5%; 
                width: 100%;
                position: absolute; 
                border-bottom: 3px black solid;
            }
            div.main-container {
                top: 5.5%;
                bottom: 5%;
                overflow: hidden; 
                position: absolute; 
                height: 100%;
                width: 100%
            }
            div.sidebar {
                top: 0px;
                left: 0px;
                height: 5%; 
                width: 10%;
                position: absolute; 
                border-right: 3px black solid;
            }
            div.main {
                float: right;
                overflow: visible; 
                overflow-y: auto; 
                height: 89%;
                width: 90%
            }
            div.bottom {
                bottom: 0px;
                height: 5%; 
                width: 100%;
                position: absolute; 
                border-top: 3px black solid;
            }
        </style>
    </head>
    <body>
        <div class="top">
            moo!
        </div>
        <div class="main-container">
            <div class="sidebar">
                moo!
            </div>
            <div class ="main">
                <?php
                require_once 'core.php';
                ?>
            </div>
        </div>
        <div class="bottom">
            moo!
        </div>
    </body>
</html>