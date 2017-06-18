<?php
$this->layout('layouts::app');

$files = Database::instance()->prepare('SELECT * FROM files WHERE email=:email');
$files->execute([
  'email' => $_SESSION['email']
]);
?>

<!-- bootstrap-daterangepicker -->
<link href="<?=APP_URL?>/inc/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<div class="row">
  <div class="page-title">
    <div class="title_left">
      <h3>User Profile</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div id="result"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>User Report <small>Activity report</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                <img class="img-responsive avatar-view" src="<?=APP_URL?>/inc/assets/images/user.png" alt="Avatar" title="Change the avatar">
              </div>
            </div>
            <h3><?=$_SESSION['username']?></h3>

            <ul class="list-unstyled user_data">
              <li><i class="fa fa-envelope-o user-profile-icon"></i> <?=$_SESSION['email']?>
              </li>

              <li>
                <i class="fa fa-clock-o user-profile-icon"></i> <?=$_SESSION['created_at']?>
              </li>
            </ul>

            <a href="<?=APP_URL?>/settings" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
            <br />

          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Files</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">

                  <!-- start user projects -->
                  <table class="data table table-striped no-margin">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Extension</th>
                        <th>Size</th>
                        <th>Status</th>
                        <th>Creation date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($data = $files->fetch()){ ?>
                        <tr>
                          <td><?=$data['name']?></td>
                          <td><?=$data['extension']?></td>
                          <td><?=File::formatSize($data['size'])?></td>
                          <td><?php if($data['public'] == 0){ ?><span class="label label-danger"><i class="fa fa-lock"><i/> Private</span><?php }else{ ?><span class="label label-success"><i class="fa fa-unlock"><i/> Public</span><?php } ?></td>
                          <td><?=$data['created_at']?></td>
                          <td>
                            <a href="<?=APP_URL . '/storage/uploads/' . $data['temp']?>" download="<?=$data['name']?>.<?=$data['extension']?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a>
                            <?php if($data['public'] == 0){ ?>
                              <a class="btn btn-success btn-sm publicBtn" id="<?=$data['ID']?>"><i class="fa fa-unlock"></i> Public</a>
                            <?php }else{ ?>
                              <a class="btn btn-warning btn-sm privateBtn" id="<?=$data['ID']?>"><i class="fa fa-lock"></i> Private</a>
                            <?php } ?>
                            <a id="<?=$data['temp'];?>" file="<?=$data['ID']?>" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <!-- end user projects -->

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(".deleteBtn").on("click", function(){
  var ID = $(this).attr('file');
  $.ajax({
    url: "<?=APP_URL?>/files/delete",
    type: "POST",
    data: "file="+$(this).attr('id'),
    success: function()
    {
      $("#tr-"+ID).fadeOut();
    }
  });
});

$(".privateBtn").on("click", function(){
  var ID = $(this).attr('id');
  $.ajax({
    url: "<?=APP_URL?>/files/private",
    type: "POST",
    data: "file="+$(this).attr('id'),
    success: function(data)
    {
      $("#result").append(data);
    }
  });
});

$(".publicBtn").on("click", function(){
  var ID = $(this).attr('id');
  $.ajax({
    url: "<?=APP_URL?>/files/public",
    type: "POST",
    data: "file="+$(this).attr('id'),
    success: function(data)
    {
      $("#result").append(data);
    }
  });
});
</script>

<!-- morris.js -->
<script src="<?=APP_URL?>/inc/assets/vendors/raphael/raphael.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/morris.js/morris.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?=APP_URL?>/inc/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?=APP_URL?>/inc/assets/vendors/moment/min/moment.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
