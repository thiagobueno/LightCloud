<?php $this->layout('layouts::app'); ?>

<!-- Datatables -->
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<?php
$files = Database::instance()->prepare('SELECT * FROM files WHERE email=:email');
$files->execute([
  'email' => $_SESSION['email']
]);
?>

<div class="row">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>My Files</h2>
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
                <th>Name</th>
                <th>Extension</th>
                <th>Size</th>
                <th>Status</th>
                <th>Creation date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while($data = $files->fetch()){ ?>
                <tr id="tr-<?=$data['ID']?>">
                  <td><?=$data['name'];?></td>
                  <td><?=$data['extension'];?></td>
                  <td><?=File::formatSize($data['size']);?></td>
                  <td><?php if($data['public'] == 0){ ?><span class="label label-danger"><i class="fa fa-lock"><i/> Private</span><?php }else{ ?><span class="label label-success"><i class="fa fa-unlock"><i/> Public</span><?php } ?></td>
                  <td><?=$data['created_at'];?></td>
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
            <thead>
              <tr>
                <th>Name</th>
                <th>Extension</th>
                <th>Size</th>
                <th>Status</th>
                <th>Creation date</th>
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
