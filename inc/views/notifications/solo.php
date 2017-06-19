<?php
$this->layout('layouts::app');

$notif = new Notification();
$notif = $notif->load(['ID' => NOTIFICATION_ID]);
$notif = $notif->fetch();
?>

<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3><i class="fa fa-bell-o"></i> Notifications</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Notification #<?=NOTIFICATION_ID?></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <div class="form-group">
            <label>Title</label>
            <input class="form-control" value="<?=$notif['title']?>" readonly/>
            <br/>
            <label>Content</label>
            <textarea class="form-control" readonly><?=$notif['content']?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
