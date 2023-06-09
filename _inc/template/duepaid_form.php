<h4 class="sub-title">
  <?php echo trans('text_update_title'); ?>
</h4>

<form class="form-horizontal" id="form-duepaid-confirm" action="duepaid.php?customer_id=<?php echo $customer['customer_id']; ?>" method="post">
  <div class="box-body">
    
    <div class="form-group">
      <label for="due" class="col-sm-4 control-label">
        <?php echo trans('label_due'); ?><i class="required">*</i>
      </label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="due" value="<?php echo currency_format(get_customer_due($customer['customer_id'])); ?>" name="due" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="paid_amount" class="col-sm-4 control-label">
        <?php echo trans('label_paid_amount'); ?><i class="required">*</i>
      </label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="paid_amount" value="<?php echo currency_format(get_customer_due($customer['customer_id'])); ?>" name="paid_amount" onclick="this.select();" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" onKeyUp="if(this.value<0){this.value='1';}">
      </div>
    </div>

    <div class="form-group">
      <label for="payment_method" class="col-sm-4 control-label">
        <?php echo trans('label_payment_method'); ?><i class="required">*</i>
      </label>
      <div class="col-sm-7">
        <select name="payment_method" class="form-control">
          <?php foreach (get_payment_methods() as $payment_method) : ?>
            <option value="<?php echo $payment_method['payment_id']; ?>">
              <?php echo $payment_method['name']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-4 control-label"></label>
      <div class="col-sm-7">            
        <button id="duepaid-confirm-btn" class="btn btn-info" data-form="#form-duepaid-confirm" data-datatable="#invoice-invoice-list" name="submit" data-loading-text="Procesando...">
          <i class="fa fa-fw fa-pencil"></i>
          <?php echo trans('button_update'); ?>
        </button>
      </div>
    </div>
    
  </div>
</form>