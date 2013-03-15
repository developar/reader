<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Reader</title>
        <style>
            body {
                overflow: hidden;
                display: block;
                margin: 0;
                padding: 0;
            }
            .top {
                top: 0;
                height: 5%; 
                width: 100%;
                position: absolute; 
                border-bottom: 3px black solid;
            }
            .main-container {
                top: 5.45%;
                bottom: 5%;
                overflow: hidden; 
                position: absolute; 
                height: 100%;
                width: 100%
            }
            .sidebar {
                top: 0;
                left: 0;
                height: 89.5%; 
                width: 10%;
                position: absolute; 
                border-right: 3px black solid;
            }
            .main {
                float: right;
                overflow: visible; 
                overflow-y: auto; 
                height: 88.5%;
                width: 88%;
                padding-top: 5px;
                padding-left: 20px;
            }
            .bottom {
                bottom: 0;
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