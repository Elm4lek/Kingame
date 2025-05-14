<html>
    <head>
        <script type="text/javascript" src="js/myJs.js"></script>
        <link rel="stylesheet" href="myCss.css">
        <style>
            html{
                font-family: "Lucida Console", "Courier New", monospace;
                font-size: 35px;
            }
            #commento{
                position: absolute;
                opacity: 0;
                z-index: -1;
            }
            .main-content {
                width: 40vw;
                height: 40vw;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;
                
                display: flex;
                flex-wrap: wrap;
            }
            .secondary-content{
                width: 32.5%;
                height: 33%;
            }
            .content {
                width: 80%;
                height: 80%;
                display: flex;
                flex-wrap: wrap;
                
                margin: 10%;
            }
            .cell{
                width: 32%;
                height: 33%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .north-west{
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .north-center{
                border-left: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .north-est{
                border-left: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .center-west{
                border-top: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .center-center{
                border-top: 1px solid rgb(121, 119, 130);
                border-left: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .center-est{
                border-top: 1px solid rgb(121, 119, 130);
                border-left: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .south-west{
                border-right: 1px solid rgb(121, 119, 130);
                border-top: 1px solid rgb(121, 119, 130);
            }
            .south-center{
                border-left: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-top: 1px solid rgb(121, 119, 130);
            }
            .south-est{
                border-left: 1px solid rgb(121, 119, 130);
                border-top: 1px solid rgb(121, 119, 130);
            }

            .north-west.secondary-content{
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .north-center.secondary-content{
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .north-est.secondary-content{
                border-left: 2px solid black;
                border-bottom: 2px solid black;
            }
            .center-west.secondary-content{
                border-top: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .center-center.secondary-content{
                border-top: 2px solid black;
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .center-est.secondary-content{
                border-top: 2px solid black;
                border-left: 2px solid black;
                border-bottom: 2px solid black;
            }
            .south-west.secondary-content{
                border-right: 2px solid black;
                border-top: 2px solid black;
            }
            .south-center.secondary-content{
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-top: 2px solid black;
            }
            .south-est.secondary-content{
                border-left: 2px solid black;
                border-top: 2px solid black;
            }

            .vittoria{
                color: red
            }
            .nonSelezionato{
                background-color: #f3f3f3;
            }
            .vittoriaG1{
                background-color: lightblue;
            }
            .vittoriaG2{
                background-color: lightcoral;
            }

        </style>
    </head>
    <body>
        <?php
        echo '<input id="stanza" type="hidden" value="'.$_SESSION["gioco"]["stanza"].'">';
        echo '<input id="username" type="hidden" value="'.$_SESSION["username"].'">';
        ?>
        <div id="main" class="main-content">        
            <!-- Row 0 -->
            <div id="0" class="secondary-content north-west">
                <div class="content">
                    <div id="0-0" class="cell north-west" onclick="mossa(0,0)"></div>
                    <div id="0-1" class="cell north-center" onclick="mossa(0,1)"></div>
                    <div id="0-2" class="cell north-est" onclick="mossa(0,2)"></div>
                    <div id="0-3" class="cell center-west" onclick="mossa(0,3)"></div>
                    <div id="0-4" class="cell center-center" onclick="mossa(0,4)"></div>
                    <div id="0-5" class="cell center-est" onclick="mossa(0,5)"></div>
                    <div id="0-6" class="cell south-west" onclick="mossa(0,6)"></div>
                    <div id="0-7" class="cell south-center" onclick="mossa(0,7)"></div>
                    <div id="0-8" class="cell south-est" onclick="mossa(0,8)"></div>
                </div>
            </div>

            <!-- Row 1 -->
            <div id="1" class="secondary-content north-center">
                <div class="content">
                    <div id="1-0" class="cell north-west" onclick="mossa(1,0)"></div>
                    <div id="1-1" class="cell north-center" onclick="mossa(1,1)"></div>
                    <div id="1-2" class="cell north-est" onclick="mossa(1,2)"></div>
                    <div id="1-3" class="cell center-west" onclick="mossa(1,3)"></div>
                    <div id="1-4" class="cell center-center" onclick="mossa(1,4)"></div>
                    <div id="1-5" class="cell center-est" onclick="mossa(1,5)"></div>
                    <div id="1-6" class="cell south-west" onclick="mossa(1,6)"></div>
                    <div id="1-7" class="cell south-center" onclick="mossa(1,7)"></div>
                    <div id="1-8" class="cell south-est" onclick="mossa(1,8)"></div>
                </div>
            </div>

            <!-- Row 2 -->
            <div id="2" class="secondary-content north-est">
                <div class="content">
                    <div id="2-0" class="cell north-west" onclick="mossa(2,0)"></div>
                    <div id="2-1" class="cell north-center" onclick="mossa(2,1)"></div>
                    <div id="2-2" class="cell north-est" onclick="mossa(2,2)"></div>
                    <div id="2-3" class="cell center-west" onclick="mossa(2,3)"></div>
                    <div id="2-4" class="cell center-center" onclick="mossa(2,4)"></div>
                    <div id="2-5" class="cell center-est" onclick="mossa(2,5)"></div>
                    <div id="2-6" class="cell south-west" onclick="mossa(2,6)"></div>
                    <div id="2-7" class="cell south-center" onclick="mossa(2,7)"></div>
                    <div id="2-8" class="cell south-est" onclick="mossa(2,8)"></div>
                </div>
            </div>

            <!-- Row 3 -->
            <div id="3" class="secondary-content center-west">
                <div class="content">
                    <div id="3-0" class="cell north-west" onclick="mossa(3,0)"></div>
                    <div id="3-1" class="cell north-center" onclick="mossa(3,1)"></div>
                    <div id="3-2" class="cell north-est" onclick="mossa(3,2)"></div>
                    <div id="3-3" class="cell center-west" onclick="mossa(3,3)"></div>
                    <div id="3-4" class="cell center-center" onclick="mossa(3,4)"></div>
                    <div id="3-5" class="cell center-est" onclick="mossa(3,5)"></div>
                    <div id="3-6" class="cell south-west" onclick="mossa(3,6)"></div>
                    <div id="3-7" class="cell south-center" onclick="mossa(3,7)"></div>
                    <div id="3-8" class="cell south-est" onclick="mossa(3,8)"></div>
                </div>
            </div>

            <!-- Row 4 -->
            <div id="4" class="secondary-content center-center">
                <div class="content">
                    <div id="4-0" class="cell north-west" onclick="mossa(4,0)"></div>
                    <div id="4-1" class="cell north-center" onclick="mossa(4,1)"></div>
                    <div id="4-2" class="cell north-est" onclick="mossa(4,2)"></div>
                    <div id="4-3" class="cell center-west" onclick="mossa(4,3)"></div>
                    <div id="4-4" class="cell center-center" onclick="mossa(4,4)"></div>
                    <div id="4-5" class="cell center-est" onclick="mossa(4,5)"></div>
                    <div id="4-6" class="cell south-west" onclick="mossa(4,6)"></div>
                    <div id="4-7" class="cell south-center" onclick="mossa(4,7)"></div>
                    <div id="4-8" class="cell south-est" onclick="mossa(4,8)"></div>
                </div>
            </div>

            <!-- Row 5 -->
            <div id="5" class="secondary-content center-est">
                <div class="content">
                    <div id="5-0" class="cell north-west" onclick="mossa(5,0)"></div>
                    <div id="5-1" class="cell north-center" onclick="mossa(5,1)"></div>
                    <div id="5-2" class="cell north-est" onclick="mossa(5,2)"></div>
                    <div id="5-3" class="cell center-west" onclick="mossa(5,3)"></div>
                    <div id="5-4" class="cell center-center" onclick="mossa(5,4)"></div>
                    <div id="5-5" class="cell center-est" onclick="mossa(5,5)"></div>
                    <div id="5-6" class="cell south-west" onclick="mossa(5,6)"></div>
                    <div id="5-7" class="cell south-center" onclick="mossa(5,7)"></div>
                    <div id="5-8" class="cell south-est" onclick="mossa(5,8)"></div>
                </div>
            </div>

            <!-- Row 6 -->
            <div id="6" class="secondary-content south-west">
                <div class="content">
                    <div id="6-0" class="cell north-west" onclick="mossa(6,0)"></div>
                    <div id="6-1" class="cell north-center" onclick="mossa(6,1)"></div>
                    <div id="6-2" class="cell north-est" onclick="mossa(6,2)"></div>
                    <div id="6-3" class="cell center-west" onclick="mossa(6,3)"></div>
                    <div id="6-4" class="cell center-center" onclick="mossa(6,4)"></div>
                    <div id="6-5" class="cell center-est" onclick="mossa(6,5)"></div>
                    <div id="6-6" class="cell south-west" onclick="mossa(6,6)"></div>
                    <div id="6-7" class="cell south-center" onclick="mossa(6,7)"></div>
                    <div id="6-8" class="cell south-est" onclick="mossa(6,8)"></div>
                </div>
            </div>
            
            <!-- Row 7 -->
            <div id="7" class="secondary-content south-center">
                <div class="content">
                    <div id="7-0" class="cell north-west" onclick="mossa(7,0)"></div>
                    <div id="7-1" class="cell north-center" onclick="mossa(7,1)"></div>
                    <div id="7-2" class="cell north-est" onclick="mossa(7,2)"></div>
                    <div id="7-3" class="cell center-west" onclick="mossa(7,3)"></div>
                    <div id="7-4" class="cell center-center" onclick="mossa(7,4)"></div>
                    <div id="7-5" class="cell center-est" onclick="mossa(7,5)"></div>
                    <div id="7-6" class="cell south-west" onclick="mossa(7,6)"></div>
                    <div id="7-7" class="cell south-center" onclick="mossa(7,7)"></div>
                    <div id="7-8" class="cell south-est" onclick="mossa(7,8)"></div>
                </div>
            </div>
            
            <!-- Row 8 -->
            <div id="8" class="secondary-content south-est">
                <div class="content">
                    <div id="8-0" class="cell north-west" onclick="mossa(8,0)"></div>
                    <div id="8-1" class="cell north-center" onclick="mossa(8,1)"></div>
                    <div id="8-2" class="cell north-est" onclick="mossa(8,2)"></div>
                    <div id="8-3" class="cell center-west" onclick="mossa(8,3)"></div>
                    <div id="8-4" class="cell center-center" onclick="mossa(8,4)"></div>
                    <div id="8-5" class="cell center-est" onclick="mossa(8,5)"></div>
                    <div id="8-6" class="cell south-west" onclick="mossa(8,6)"></div>
                    <div id="8-7" class="cell south-center" onclick="mossa(8,7)"></div>
                    <div id="8-8" class="cell south-est" onclick="mossa(8,8)"></div>
                </div>
            </div>
        </div>
    </body>
</html>