<?php
$this->layout('layouts::app');

$group = new Group();
$group = $group->findOrFail(GROUP_ID);
$group = $group->fetch();
?>

<!-- Datatables -->
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?=APP_URL?>/inc/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


<div class="">
  <div class="clearfix"></div>
  <div id="result"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-edit"></i> Edit group #<?=$group['ID']?></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="editForm" data-parsley-validate class="form-horizontal form-label-left">
            <input value="<?=$group['ID']?>" name="ID" readonly required hidden/>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Group name</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required name="name" class="form-control col-md-7 col-xs-12" value="<?=$group['name']?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Is Admin ?</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="admin" required>
                  <option value="0" <?php if($group['admin'] == 0){ ?>selected<?php } ?>>No</option>
                  <option value="1" <?php if($group['admin'] == 1){ ?>selected<?php } ?>>Yes</option>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button class="btn btn-primary" type="button">Cancel</button>
                <button class="btn btn-primary" type="reset">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-key"></i> Group permissions</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $permissions = new Permission();
              $permissions = $permissions->load(['group_ID' => $group['ID']]);
              while($data = $permissions->fetch()){
                ?>
                <tr>
                  <th><?=$data['name']?></th>
                  <th><button id="<?=$group['ID']?>" permission="<?=data['name']?>" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button></th>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-plus"></i> Add permission</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="permissionsAddForm" data-parsley-validate class="form-horizontal form-label-left">
            <input name="ID" value="<?=GROUP_ID?>" required readonly hidden/>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="permission" required>
                  <?php
                  $g = new Group();
                  $g->getByID($group['ID']);
                  $permissions = json_decode(file_get_contents(__DIR__ . '/../../../storage/permissions.json'));
                  foreach ($permissions as $key => $value) {
                  ?>
                    <option <?php if($g->hasPermission($key)){ ?>disabled<?php } ?>><?=$key?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Add</button>
              </div>
            </div>
          </form>
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

<script type="text/javascript">
  $("#editForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: "<?=APP_URL?>/admin/groups/edit",
      type: "POST",
      data: $(this).serialize(),
      success: function(data)
      {
        $("#result").html(data);
      }
    });
  });

  $("#permissionsAddForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: "<?=APP_URL?>/admin/permissions/add",
      type: "POST",
      data: $(this).serialize(),
      success: function(data)
      {
        $("#result").html(data);
      }
    });
  });

  $(".deleteBtn").on("click", function(){
    var name = $(this).attr("permission");
    var group = $(this).attr("ID");

    $.ajax({
      url: "<?=APP_URL?>/admin/permissions/delete",
      type: "POST",
      data: "permission="+name+"&ID="+group,
      success: function(data)
      {
        $("#result").html(data);
      }
    });
  });
</script>
