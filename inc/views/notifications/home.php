<?php $this->layout('layouts::app'); ?>

<!-- Datatables -->
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<?php
$notif = new Notification();
$notifs = $notif->showAll();
?>

<div class="row">

  <div class="page-title">
    <div class="title_left">
      <h3><i class="fa fa-bell-o"></i> Notifications</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>My Notifications</h2>
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
                <th>Title</th>
                <th>Content</th>
                <th>Creation date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($data = $notifs->fetch()){ ?>
                <tr id="tr-<?=$data['ID']?>">
                  <td><?=$data['title'];?></td>
                  <td><?=$data['content'];?></td>
                  <td><?=$data['created_at'];?></td>
                  <td>
                    <a id="<?=$data['ID']?>" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
            <thead>
              <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Creation date</th>
                <th>Actions</th>
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
  var ID = $(this).attr('id');
  $.ajax({
    url: "<?=APP_URL?>/notifications/delete",
    type: "POST",
    data: "ID="+ID,
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
