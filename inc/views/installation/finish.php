<?php $this->layout('layouts::install'); ?>
<p>
  <div id="result"></div>
  <p>The installation of your system is now finished, enjoy !</p>

  <button id="finishBtn" class="btn btn-success center-block">Get Started <i class="fa fa-check-circle"></i></button>
</p>

<script type="text/javascript">
$("#finishBtn").on("click", function(){
  $.ajax({
    url: "<?=APP_URL?>/installation/finish",
    type: "POST",
    success: function(data)
    {
      $("#result").html(data);
    }
  });
});
</script>
