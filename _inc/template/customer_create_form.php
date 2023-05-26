<form id="create-customer-form" class="form-horizontal" action="customer.php" method="post" enctype="multipart/form-data">
  <input type="hidden" id="action_type" name="action_type" value="CREATE">
  <div class="box-body">

    <?php 

    $mat_store = store();
    $required_i ='';
    $required ='';
    if ($mat_store['fac_electronica'] == 'S') {
      $required_i = '<i class="required">*</i>';
      $required   = 'required';
    }

    $tipo_doc  = array(
      "CI" => "Cedula Identidad",
      "RUC" => "RUC",
      "PASAPORTE" => "Pasaporte",
      );
    $option ='';
    foreach ($tipo_doc as $k => $v) {
      $option .= "<option value='$k'>$v</option>";
    }

        $col = !empty($_GET['box_state']) ? 'col-sm-3' : 'col-sm-6';
 
    ?>

    <div class="">
      <div class="<?php echo $col;?> ">
        <label for>
         Tipo Documento <i class="required">*</i>
       </label>
       <select class="form-control" id="type_document" name="type_document">
        <?php echo $option ?>
      </select>    
    </div>
  </div>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="document">
        <?php echo sprintf(trans('label_document'), null); ?><i class="required">*</i>
      </label>
      <input type="number" class="form-control" id="document" value="<?php echo isset($request->post['document']) ? $request->post['document'] : null; ?>" name="document" required>
    </div>
  </div>
  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="customer_name">
        Nombres <i class="required">*</i>
      </label>
      <input type="text" class="form-control text-capitalize" id="customer_name" value="<?php echo isset($request->post['customer_name']) ? $request->post['customer_name'] : null; ?>" name="customer_name" required>
    </div>
  </div>

  <div class="">
  <div class="<?php echo $col;?> ">
    <label for="type_person">
      Tipo Persona
    </label>
    <select type="text" class="form-control" id="type_person" name="type_person">
      <option value="PERSONA_NATURAL" >NATURAL</option>
      <option value="PERSONA_JURIDICA">JURIDICA</option>
      <option value="PASAPORTE">EXTRANJERO</option>
    </select>
  </div>
</div>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="customer_mobile">
        <?php echo sprintf(trans('label_phone'), null); echo $required_i; ?> 
      </label>
      <input type="text" class="form-control" id="customer_mobile" value="<?php echo isset($request->post['customer_mobile']) ? $request->post['customer_mobile'] : null; ?>" name="customer_mobile" <?php echo $required ?>>
    </div>
  </div>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="dob">
        <?php echo sprintf(trans('label_date_of_birth'), null); ?>
      </label>
      <input type="date" class="form-control" id="dob" value="<?php echo isset($request->post['dob']) ? $request->post['dob'] : null; ?>" name="dob" autocomplete="off">
    </div>
  </div>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="customer_email">
        <?php echo sprintf(trans('label_email'), null); echo $required_i;?>
      </label>
      <input type="email" class="form-control" id="customer_email" value="<?php echo unique_id(6);?>@gmail.com" name="customer_email" <?php echo $required ?>>
    </div>
  </div>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="customer_sex">
        <?php echo sprintf(trans('label_sex'), null); ?>
      </label>
      <select id="customer_sex" name="customer_sex" class="form-control" required>
        <option value="1"<?php echo isset($request->post['customer_sex']) && $request->post['customer_sex'] == '1' ? ' selected' : null; ?>>
          <?php echo trans('label_male'); ?>
        </option>
        <option value="2"<?php echo isset($request->post['customer_sex']) && $request->post['customer_sex'] == '2' ? ' selected' : null; ?>>
          <?php echo trans('label_female'); ?>
        </option>
        <option value="3"<?php echo isset($request->post['customer_sex']) && $request->post['customer_sex'] == '3' ? ' selected' : null; ?>>
          <?php echo trans('label_others'); ?>
        </option>
      </select>
    </div>
  </div>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="customer_age">
        <?php echo sprintf(trans('label_age'), null); ?>
      </label>
      <input type="number" class="form-control" id="customer_age" value="<?php echo isset($request->post['customer_age']) ? $request->post['customer_age'] : null; ?>" name="customer_age" onKeyUp="if(this.value>140){this.value='140';}else if(this.value<0){this.value='0';}">
    </div>
  </div>

  <?php if (get_preference('invoice_view') == 'indian_gst') : ?>
    <div class="">
      <div class="<?php echo $col;?> ">
        <label for="gtin">
          <?php echo trans('label_gtin'); ?>
        </label>
        <input type="text" class="form-control" id="gtin" value="" name="gtin">
      </div>
    </div>
  <?php endif;?>

  <div class="">
    <div class="<?php echo $col;?> ">
      <label for="customer_address">
        <?php echo sprintf(trans('label_address'), null); echo $required_i; ?>
      </label>
      <input class="form-control" id="customer_address" name="customer_address" value="<?php echo isset($request->post['customer_address']) ? $request->post['customer_address'] : null; ?>" <?php echo $required ?>>
    </div>
  </div>

   <?php if (get_preference('invoice_view') == 'indian_gst') : ?>
    <div class="">
      <div class="<?php echo $col;?> ">
        <label for="customer_state">
          <?php echo sprintf(trans('label_state'), null); ?><i class="required">*</i>
        </label>
        <?php echo stateSelector(isset($request->post['customer_state']) ? $request->post['customer_state'] : null, 'customer_state', 'customer_state'); ?>
      </div>
    </div>
    <?php else : ?>
      <div class="">
        <div class="<?php echo $col;?> ">
          <label for="customer_state">
            <?php echo sprintf(trans('label_state'), null); echo $required_i;?>
          </label>
          <select  class="form-control customer_state" id="customer_state" name="customer_state" <?php echo $required_i ?>>
             <option value=""><-- Seleccionar --></option>';
          <?php foreach (get_department() as $k => $v): 
            $selected = '';
            if (isset($request->post['customer_state'])) 
              $selected = $request->post['customer_state'] == $v['code']? 'selected' : '';       
              
            ?>
            <option value="<?php echo $v['code'] ?>" <?php echo $selected ?>><?php echo $v['name'] ?></option>
          <?php endforeach ?>
          </select>        
        </div>
      </div>
    <?php endif; ?>
    <?php 
     $option = '<option value=""><-- Seleccionar --></option>';
    if (isset($request->post['customer_state'])) {     
      foreach (get_city($request->post['customer_state']) as $i => $city) {
        $selected = $city['code'] == $request->post['customer_city']? 'selected' : null;
        $option .= "<option value='".$city['code']."' ".$selected.">".$city['name']."</option>";
      }
    }
    ?>
     <div class="">
      <div class="<?php echo $col;?> ">
        <label for="customer_city">
          <?php echo sprintf(trans('label_city'), null); echo $required_i;?>
        </label>
        <select  class="form-control" id="customer_city" name="customer_city" <?php echo $required_i ?>>
          <?php echo  $option ?>
        </select>       
      </div>
    </div>


    <div class="">
      <div class="<?php echo $col;?> ">
        <label for="country">
          <?php echo trans('label_country'); ?>
        </label>
        <?php echo countrySelector(isset($request->post['customer_country']) ? $request->post['customer_country'] : null, 'customer_country', 'customer_country'); ?>
      </div>
    </div>

      <div class="">
    <div class="<?php echo $col;?> ">
      <label for="credit_balance">
        <?php echo sprintf(trans('label_credit_balance'), null); ?>
      </label>
      <input type="text" class="form-control" id="credit_balance" value="0" name="credit_balance" onclick="this.select();" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" onKeyUp="if(this.value<0){this.value='0';}">
    </div>
  </div>

    <div class="">
      <div class="<?php echo $col;?> ">
        <label for="status">
          <?php echo trans('label_status'); ?>
        </label>
        <select id="status" class="form-control" name="status" >
          <option <?php echo isset($request->post['status']) && $request->post['status'] == '1' ? 'selected' : null; ?> value="1">
            <?php echo trans('text_active'); ?>
          </option>
          <option <?php echo isset($request->post['status']) && $request->post['status'] == '0' ? 'selected' : null; ?> value="0">
            <?php echo trans('text_inactive'); ?>
          </option>
        </select>
      </div>
    </div>

    <div class="col-sm-6 col-sm-offset-3 store-selector">
      <label class=" control-label">
        <?php echo trans('label_store'); ?><i class="required">*</i>
      </label>
      <div class="checkbox selector">
        <label>
          <input type="checkbox" onclick="$('input[name*=\'customer_store\']').prop('checked', this.checked);"> 
          Seleccionar / Deseleccionar
        </label>
      </div>
      <div class="filter-searchbox">
        <input ng-model="search_store" class="form-control" type="text" id="search_store" placeholder="<?php echo trans('search'); ?>">
      </div>
      <div class="well well-md store-well"> 
        <div filter-list="search_store">
          <?php foreach(get_stores() as $the_store) : ?>                    
            <div class="checkbox">
              <label>                         
                <input type="checkbox" name="customer_store[]" value="<?php echo $the_store['store_id']; ?>"<?php echo $the_store['store_id'] == store_id() ? ' checked' : null;?>>
                <?php echo $the_store['name']; ?>
              </label>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>  

    <div class="hide">
      <div class="col-sm-3 ">
        <label for="sort_order">
          <?php echo sprintf(trans('label_sort_order'), null); ?>
        </label>
        <input type="number" class="form-control" id="sort_order" value="<?php echo isset($request->post['sort_order']) ? $request->post['sort_order'] : 0; ?>" name="sort_order" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-6  col-sm-offset-5">
        <button class="btn btn-info" id="create-customer-submit" type="submit" name="create-customer-submit" data-form="#create-customer-form" data-loading-text="Saving...">
          <span class="fa fa-fw fa-save"></span>
          <?php echo trans('button_save'); ?>
        </button> 
        <button type="reset" class="btn btn-danger" id="reset" name="reset"><span class="fa fa-fw fa-circle-o"></span>
          <?php echo trans('button_reset'); ?>
        </button>
      </div>
    </div>

  </div>
</form>