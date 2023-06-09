<form id="topup-giftcard-form" class="form-horizontal" action="giftcard.php" method="post" enctype="multipart/form-data">
  <input type="hidden" id="action_type" name="action_type" value="TOPUP">
  <input type="hidden" id="id" name="id" value="<?php echo $giftcard['id'];?>">
  <div class="box-body">

    <div class="form-group">
      <label for="amount" class="col-sm-3 control-label">
        <?php echo trans('label_amount'); ?><i class="required">*</i>
      </label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="amount" name="amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" onKeyUp="if(this.value<0){this.value='1';}" required>
      </div>
    </div>

    <div class="form-group">
      <label for="expiry" class="col-sm-3 control-label">
        <?php echo trans('label_expiry_date'); ?><i class="required">*</i>
      </label>
      <div class="col-sm-7">
        <input type="date" class="form-control" id="expiry" name="expiry" autocomplete="off" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label"></label>
      <div class="col-sm-7">
        <button class="btn btn-info" id="giftcard-topup-save" type="submit" name="giftcard-topup-save" data-form="#topup-giftcard-form" data-datatable="#giftcard-giftcard-list" data-loading-text="Procesando...">
          <span class="fa fa-fw fa-money"></span> 
          <?php echo trans('button_topup_now'); ?>
        </button>  
      </div>
    </div>
     
  </div>
</form>