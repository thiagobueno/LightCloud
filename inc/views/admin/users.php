<?php $this->layout('layouts::app'); ?>

<!-- Datatables -->
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<?php
$users = new User();
$users = $users->loadAll();
?>

<div class="row">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-users"></i> Users</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div id="result"></div>


          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Group</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while($data = $users->fetch()){ ?>
                <tr>
                  <th><?=$data['ID']?></th>
                  <th><?=$data['username']?></th>
                  <th><?=$data['email']?></th>
                  <th><?php if($data['rank'] > 2){ ?><span class="label label-success">Admin</span><?php }else{ ?><span class="label label-default">Other</span><?php } ?></th>
                  <th><?=$data['created_at']?></th>
                  <th><?=$data['updated_at']?></th>
                  <th>SOON</th>
                </tr>
              <?php } ?>
            </tbody>
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Group</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>


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

<!-- Datatables -->
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=APP_URL?>/inc/assets/vendors/pdfmake/build/vfs_fonts.js"></script>
