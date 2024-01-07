
<div class="row">
  <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #00CED1;">
    <div class="container">
      <div class="navbar-header">
        <a href="home.php">
          <span class="h3" style="position: relative; top: 11px; left: 10px; margin-right: 10px;color: #FFFFFF">Order It Web Pannel</span>
        </a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="mynav">
        <ul class="nav navbar-nav">
                <?php 
            if($_SESSION['type'] == "Admin")
            echo '
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown"  href="#" style="color: #000000; font-weight: bold">Activities<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Order Status</li>
                <li><a href="orders.php">Running Orders</a></li>
                  <li><a href="sales.php">Sales Reports</a></li>
              </ul>
            </li>

        
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #000000; font-weight: bold">Management
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"><span class="glyphicon glyphicon-user"></span> User Activity</li>
                  <li><a href="UserAdd.php"><span class="glyphicon glyphicon-plus-sign"></span> Add User</a></li>
                  <li><a href="UserList.php"><span class="glyphicon glyphicon-th-list"></span> List User</a></li>
                  <li><a href="Userremove.php"><span class="glyphicon glyphicon-minus-sign"></span> Remove User</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Table Activity</li>
                  <li><a href="TableAdd.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Table</a></li>
                  <li><a href="TableList.php"><span class="glyphicon glyphicon-th-list"></span> List Table</a></li>
                  <li><a href="tableremove.php"><span class="glyphicon glyphicon-minus-sign"></span> Remove Table</a></li>
                  <li><a href="TableReset.php"><span class="glyphicon glyphicon-minus-sign"></span> Reset Table</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header"><span class="glyphicon glyphicon-cutlery"></span> Food &amp; OfferItem Activity</li>
                  <li><a href="FoodOfferAdd.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Food/Offer</a></li>
                  <li><a href="FoodOfferList.php"><span class="glyphicon glyphicon-th-list"></span> List Food/Offer</a></li>
                </ul>
              </li>
              ' ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <div class="row"><?php setAdminLink() ?></div>
            </ul>
          </div>
        </div>
      </nav>
    </div>
