<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
		if(isset($_SESSION['total_price'])){
		
?>

<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "6eLyk2";

// Merchant Salt as provided by Payu
$SALT = "TRCIAWq8";


$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onLoad="submitPayuForm()">
    
    <br/>
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>

<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_login_pannel">
	
	 <div class="left_content">
      <div class="title"></span>Make Payment</div>
      
   
        <div class="contact_form">
		<div style="margin-top:-40px">
          <div class="form_subtitle">Order Details</div>
          <form action="<?php echo $action; ?>" method="post" name="payuForm">
			  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
			  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
			  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
			  <input type="hidden" name="surl" value="http:\\craftspoint.in/sucess.php" size="64" />
			  <input type="hidden" name="furl" value="http:\\craftspoint.in/failure.php" size="64" />
			  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
		  <table>
		 	 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Name</strong></label>
					  <input type="text" name="firstname"  value="<?php echo $_SESSION['pay_name']; ?>" readonly="readonly" style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
				
			</tr>
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Email</strong></label>
					 <input type="text" name="email" value="<?php echo $_SESSION['pay_email']; ?>" readonly="readonly" style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
			
			</tr>
			
			 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Amount</strong></label>
					  <input type="text" name="product_total" value="<?php echo $_SESSION['total_price']; ?>" readonly="readonly" style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
			
			</tr>
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Shipping Cost</strong></label>
					  <input type="text" name="amount" value="<?php echo $_SESSION['shipping_cost']; ?>" readonly="readonly" style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
			
			</tr>
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Total Amount</strong></label>
					  <input type="text" name="amount" value="<?php echo ($_SESSION['total_price']+$_SESSION['shipping_cost']); ?>" readonly="readonly" style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
			
			</tr>
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Product Info</strong></label>
					  <textarea readonly="readonly"  style="min-width:100%;border:none; color:green; font-size:18px; max-width:100%; min-height:100px; max-height:100px;"><?php echo  $_SESSION['PRODUCT_INFO'];?></textarea>
					 <input type="hidden" name="productinfo"  value="<?php echo $_SESSION['products']; ?>" readonly="readonly" style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
			
			</tr>
			 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Phone</strong></label>
					<input type="text" name="phone" value="<?php echo $_SESSION['pay_phone']; ?>" readonly style="min-width:100px;border:none; color:green; font-size:18px; "/>
					</div>
				
			</tr>
			
			
			 <tr>
				<td rowspan="4" colspan="4">
					<div class="form_row">
					  <label class="contact"><strong>Address</strong></label>
					  <textarea readonly="readonly"  style="min-width:100%;border:none; color:green; font-size:18px; max-width:100%; min-height:100px; max-height:100px;"><?php echo  $_SESSION['pay_address'];?></textarea>
					   <input type="hidden" name="address1" value="<?php echo $_SESSION['pay_address']; ?>" readonly style="min-width:190px;border:none; color:green; font-size:18px; "/>
					</div>
				</td>
			
			</tr>
			</table>
          
            <div class="form_row">
			 <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Make Payment"  style=" background:#FF9900; border:none; font-size:18px; cursor:pointer; color:#FFFFFF;"/></td>
          <?php } ?>
    
            </div>
          </form>
		  </div>
        </div>
</div>
     
 
   
</div>
<div style="height:30px; width:100%;">
</div>


<?php
}
else{
	header('location:error.php');
}

ob_end_flush();
require_once(COMMON.FOOTER);
?>