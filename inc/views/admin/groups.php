<?php
$this->layout('layouts::app');
?>

<!-- Datatables -->
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<?php
$groups = new Group();
$groups = $groups->loadAll();
?>

<div class="row">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-users"></i> Groups</h2>
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
                <th>Name</th>
                <th>Admin</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($data = $groups->fetch()){
                ?>
                <tr>
                  <th><?=$data['ID']?></th>
                  <th><?=$data['name']?></th>
                  <th><?php if($data['admin'] == 1){ ?> <span class="label label-success">Admin</span> <?php }else{ ?> <span class="label label-danger">Other</span> <?php } ?></th>
                  <th>SOON</th>
                </tr>
              <?php } ?>
            </tbody>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Admin</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>


        </div>
      </div>
    </div>
  </div>
</div>

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
