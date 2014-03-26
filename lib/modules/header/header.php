<header id="topNav" class="clearfix">
                <p class="pull-left loggedin">User: <?php  echo $_SESSION["name"]; ?></p>
            
            <img src="img/icons/settings.png" id="settingsMenu" class="pull-right" alt="" />
            <ul id="AdminMenu">                
                <li><a href="app.php"><img src="img/icons/reload.png" alt="" />Main</a></li>
                <li class="adduser"><img src="img/icons/adduser.png" alt="" />Add user</li>
                <li class="editusers"><img src="img/icons/editusers.png" alt="" />Edit users</li>
                <li class="courier"><img src="img/icons/delivery.png" alt="" />Courier Services</li>
                <li><a href="index.php?logout=1"><img src="img/icons/logout.png" alt="" /> Logout</a></li>
            </ul>
            
            
            
            <nav>
                <a href="app.php" class="btn btn-default"> Main</a>
                <a href="close_order.php" class="btn btn-default">Close order</a>
                <a href="goods_in.php" class="btn btn-default"> Full list</a>
            </nav>
            
        </header>