<h4 class="sub-title">
  <?php echo trans('text_update_title'); ?>
</h4>

<?php 

$mat_store = store();
$required_i ='';
$required ='';
if ($mat_store['fac_electronica'] == 'S') {
  $required_i = '<i class="required">*</i>';
  $required   = 'required';
}
$tipo_doc  = array(
  "CC" => "Cedula Ciudadania",
  "NIT" => "Nit",
  "PASAPORTE" => "Pasaporte",
  "RC" => "Registro Civil",
  "TI" => "Tarjeta Identidad",
  "CE" => "Cedula Extrangeria");
$option ='';
foreach ($tipo_doc as $k => $v) {
  $selected = $customer['type_document'] == $k ? 'selected' : null ;
  $option .= "<option value='$k' $selected>$v</option>";
}
?>

<form class="form-horizontal" id="customer-form" action="customer.php" method="post">

  <input type="hidden" id="action_type" name="action_type" value="UPDATE">
  <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
  
  <div class="box-body">

   <div class="">
    <div class="col-sm-6">
      <label for>
       Tipo Documento <i class="required">*</i>
     </label>
     <select class="form-control" id="type_document" name="type_document">
      <?php echo $option ?>
    </select>    
  </div>
</div>

<div class="">
  <div class="col-sm-6">
    <label >
      <?php echo sprintf(trans('label_document'), null); echo $required_i;?>
    </label>
    <input type="text" class="form-control" id="document" value="<?php echo $customer['document']; ?>" name="document" <?php echo $required; ?>>
  </div>
</div>

<div class="">
  <div class="col-sm-6">
    <label for="customer_name">
      <?php echo sprintf(trans('label_name'), null); ?><i class="required">*</i>
    </label>
    <input type="text" class="form-control text-capitalize" id="customer_name" value="<?php echo $customer['customer_name']; ?>" name="customer_name" required>
  </div>
</div>

<div class="">
  <div class="col-sm-6">
    <label for="type_person">
      Tipo Persona<i class="required">*</i>
    </label>
    <select type="text" class="form-control" id="type_person" name="type_person" required>
      <option value="PERSONA_NATURAL" <?php echo $customer['type_person'] == 'PERSONA_NATURAL' ? 'selected' : null; ?> > Persona Natural</option>
      <option value="PERSONA_JURIDICA" <?php echo $customer['type_person'] == 'PERSONA_JURIDICA' ? 'selected' : null; ?> > Persona Juridica</option>
    </select>
  </div>
</div>

<div class="">
  <div class="col-sm-6">
    <label for="customer_mobile">
      <?php echo trans('label_phone'); echo $required_i;?>
    </label>
    <input type="text" class="form-control" id="customer_mobile" value="<?php echo $customer['customer_mobile']; ?>" name="customer_mobile" <?php echo $required; ?>>
  </div>
</div>

<div class="">
  <div class="col-sm-6">
    <label for="dob">
      <?php echo sprintf(trans('label_date_of_birth'), null); ?>
    </label>
    <input type="date" class="form-control" id="dob" value="<?php echo $customer['dob']; ?>" name="dob" autocomplete="off">
  </div>
</div>

<div class="">
  <div class="col-sm-6">
    <label for="customer_email">
      <?php echo sprintf(trans('label_email'), null); echo $required_i; ?>
    </label>
    <input type="email" class="form-control" id="customer_email" value="<?php echo $customer['customer_email']; ?>" name="customer_email" <?php echo $required ?>>
  </div>
</div>

<div class="">
  <div class="col-sm-3">
    <label for="customer_sex">
      <?php echo sprintf(trans('label_sex'), null); ?>
    </label>
    <select name="customer_sex" class="form-control" required>
      <option <?php echo $customer['customer_sex'] == 1 ? 'selected' : null; ?> value="1">
        <?php echo trans('text_male'); ?>
      </option>
      <option <?php echo $customer['customer_sex'] == 2 ? 'selected' : null; ?> value="2">
        <?php echo trans('text_female'); ?>
      </option>
    </select>
  </div>
</div>

<div class="">
  <div class="col-sm-3">
    <label for="customer_age">
      <?php echo sprintf(trans('label_age'), null); ?>
    </label>
    <input type="number" class="form-control" id="customer_age" value="<?php echo $customer['customer_age']; ?>" name="customer_age" onKeyUp="if(this.value>140){this.value='140';}else if(this.value<0){this.value='0';}">
  </div>
</div>

<?php if (get_preference('invoice_view') == 'indian_gst') : ?>
  <div class="">
    <div class="col-sm-6">
      <label for="gtin">
        <?php echo trans('label_gtin'); ?>
      </label>
      <input type="text" class="form-control" id="gtin" value="<?php echo $customer['gtin']; ?>" name="gtin">
    </div>
  </div>
<?php endif;?>

<div class="">
  <div class="col-sm-12">
    <label for="customer_address">
      <?php echo sprintf(trans('label_address'), null); echo $required_i; ?>
    </label>
    <input class="form-control" id="customer_address" name="customer_address" value="<?php echo $customer['customer_address']; ?>" <?php echo $required ?>>
  </div>
</div>

<?php if (get_preference('invoice_view') == 'indian_gst') : ?>
  <div class="">
    <div class="col-sm-6">
      <label for="customer_state">
        <?php echo sprintf(trans('label_state'), null); ?>
      </label>
      <?php echo stateSelector($customer['customer_state'], 'customer_state', 'customer_state'); ?>
    </div>
  </div>
  <?php else : ?>
    <div class="">
      <div class="col-sm-6">
        <label for="customer_state">
          <?php echo sprintf(trans('label_state'), null); echo $required_i;?>
        </label>
        <select  class="form-control customer_state" id="customer_state" name="customer_state" <?php echo $required ?>>
          <option value=""><-- seleccione --></option>
          <?php foreach (get_department() as $k => $v): 
            $selected = '';
            if (isset($customer['customer_state'])) 
              $selected = $customer['customer_state'] == $v['code']? 'selected' : '';
            ?>
            <option value="<?php echo $v['code'] ?>" <?php echo $selected ?>><?php echo $v['name'] ?></option>
          <?php endforeach ?>
        </select>  
      </div>
    </div>
  <?php endif; ?>
    <?php 
     $option = '<option value=""><-- seleccione --></option>';
    if (isset($customer['customer_state'])) {     
      foreach (get_city($customer['customer_state']) as $i => $city) {
        $selected = $city['code'] == $customer['customer_city']? 'selected' : '';
        $option .= "<option value='".$city['code']."' ".$selected.">".$city['name']."</option>";
      }
    }
    ?>
  <div class="">
    <div class="col-sm-6">
      <label for="customer_city">
        <?php echo sprintf(trans('label_city'), null); echo $required_i;?>
      </label>
      <select  class="form-control" id="customer_city" name="customer_city" <?php echo $required_i ?>>
        <?php echo  $option ?>
      </select>    
    </div>
  </div>

  <div class="">
    <div class="col-sm-6">
      <label for="country">
        <?php echo trans('label_country'); ?>
      </label>
      <?php echo countrySelector($customer['customer_country'], 'customer_country', 'customer_country'); ?>
    </div>
  </div>

  <div class="">
    <div class="col-sm-6">
      <label for="status">
        <?php echo trans('label_status'); ?>
      </label>
      <select id="status" class="form-control" name="status" >
        <option <?php echo isset($customer['status']) && $customer['status'] == '1' ? 'selected' : null; ?> value="1">
          <?php echo trans('text_active'); ?>
        </option>
        <option <?php echo isset($customer['status']) && $customer['status'] == '0' ? 'selected' : null; ?> value="0">
          <?php echo trans('text_inactive'); ?>
        </option>
      </select>
    </div>
  </div>

  <div class="">
    <div class="col-sm-12 store-selector">
      <label>
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
      <div class="well well-sm store-well">
        <div filter-list="search_store">
          <?php foreach(get_stores() as $the_store) : ?>                    
            <div class="checkbox">
              <label>                         
                <input type="checkbox" name="customer_store[]" value="<?php echo $the_store['store_id']; ?>" <?php echo in_array($the_store['store_id'], $customer['stores']) ? 'checked' : null; ?>>
                <?php echo $the_store['name']; ?>
              </label>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="hide">
    <div class="col-sm-6">
      <label for="sort_order">
        <?php echo sprintf(trans('label_sort_order'), null); ?>
      </label>
      <input type="number" class="form-control" id="sort_order" value="<?php echo $customer['sort_order']; ?>" name="sort_order">
    </div>
  </div>

  <div class="">        
    <div class="col-sm-6">
      <label for="customer_address"></label>
      <button id="customer-update" data-form="#customer-form" data-datatable="#customer-customer-list" class="btn btn-block btn-info" name="btn_edit_customer" data-loading-text="Updating...">
        <span class="fa fa-fw fa-pencil"></span>
        <?php echo trans('button_update'); ?>
      </button>
    </div>
  </div>

</div>
</form>