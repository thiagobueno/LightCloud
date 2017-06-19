<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An another opensource cloud system.">
    <meta name="author" content="Roch Blondiaux">

    <link rel="shortcut icon" href="<?=APP_URL?>/inc/assets/images/favicon.ico" type="image/x-icon">

    <title><?=APP_NAME?> | Powered by LightCloud</title>

    <!-- Bootstrap -->
    <link href="<?=APP_URL?>/inc/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=APP_URL?>/inc/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="<?=APP_URL?>/inc/assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Dropzone -->
    <link href="<?=APP_URL?>/inc/assets/css/jquery.fileuploader.css" rel="stylesheet">
    <script src="<?=APP_URL?>/inc/assets/js/jquery.fileuploader.min.js"></script>
    <!-- NProgress -->
    <link href="<?=APP_URL?>/inc/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=APP_URL?>/inc/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=APP_URL?>/inc/assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=APP_URL?>/" class="site_title"><i class="fa fa-lightbulb-o fa-lg fa-fw"></i> <span>LightCloud</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <i class="fa fa-user fa-5x fa-fw"></i>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><b><?=$_SESSION['username']?></b></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=APP_URL?>/"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?=APP_URL?>/files"><i class="fa fa-files-o"></i> My Files</a></li>
                  <li><a href="<?=APP_URL?>/notifications"><i class="fa fa-bell-o"></i> My Notifications</a></li>
                  <li><a href="<?=APP_URL?>/profile"><i class="fa fa-user"></i> My account</a></li>
                  <li><a href="<?=APP_URL?>/settings"><i class="fa fa-gears"></i> My Settings</a></li>
                </ul>
              </div>
              <?php if(User::isAdmin()){ ?>
                <div class="menu_section">
                <h3>Admin</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=APP_URL?>/admin/"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?=APP_URL?>/admin/files"><i class="fa fa-files-o"></i> Files</a></li>
                  <li><a href="<?=APP_URL?>/admin/users"><i class="fa fa-users"></i> Users</a></li>
                  <li><a href="<?=APP_URL?>/admin/settings"><i class="fa fa-gears"></i> Settings</a></li>
                </ul>
              </div>
              <?php } ?>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="<?=APP_URL?>/settings" data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=APP_URL?>/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user fa-fw"></i><?=$_SESSION['username'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?=APP_URL?>/profile"> Profile</a></li>
                    <li>
                      <a href="<?=APP_URL?>/settings">
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="<?=APP_URL?>/help">Help</a></li>
                    <li><a href="<?=APP_URL?>/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!-- Notifications -->
                <?php
                $notif = new Notification();
                /** Count **/
                $notifs_ = $notif->count(['email' => $_SESSION['email']]);
                /** Get all notifs **/
                $notifs = $notif->load(['email' => $_SESSION['email']]);
                ?>
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green"><?=$notifs_?></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <?php while($data = $notifs->fetch()){ ?>
                      <li>
                        <a href="<?=APP_URL?>/notifications/<?=$data['ID']?>">
                          <span class="image"><i class="<?=$data['icon']?>"></i></span>
                          <span>
                            <span><?=$data['title']?></span>
                            <span class="time"><?=$data['created_at']?></span>
                          </span>
                          <span class="message">
                            <?=$data['content']?>
                          </span>
                        </a>
                      </li>
                    <?php } ?>
                    <li>
                      <div class="text-center">
                        <a href="<?=APP_URL?>/notifications">
                          <strong>See All Notifications</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?=$this->section('content');?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            LightCloud © 2017 | Powered by LightCloud | Version <?=APP_VERSION?> | Developed by <a href="https://roch-blondiaux.com">Roch Blondiaux</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Bootstrap -->
    <script src="<?=APP_URL?>/inc/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=APP_URL?>/inc/assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- iCheck -->
    <script src="<?=APP_URL?>/inc/assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=APP_URL?>/inc/assets/js/custom.min.js"></script>

  </body>
</html>
