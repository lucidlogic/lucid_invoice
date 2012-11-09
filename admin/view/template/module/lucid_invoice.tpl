<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php //echo "<pre>";print_r($stores);echo "</pre>";exit;?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 ><?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content" id="content">
       <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <div class="vtabs">
              <?foreach($stores as $store){?>
             <a href="#tab-store-<?php echo $store['store_id'];?>" id="store-<?php echo $store['store_id'];?>" style="" ><?php echo $store['name'];?></a>
           <?php } ?>  
      </div>
    
 <?foreach($stores as $store){ 
 $store_id = $store['store_id'];
 ?> 
 
    <div id='tab-store-<?php echo $store_id; ?>' class="vtabs-content" style="display: block; ">  
      <table class="form">
        <tr>
          <td><?php echo $invoice_logo; ?></td>
          <td><div class="image_<?php echo $store_id?>"><img src="/image/<?php $var = 'lucid_invoice_logo_'.$store_id; echo $$var; ?>"  id="thumb-logo_<?php echo $store_id?>" />
             <input type="hidden" name="lucid_invoice_logo_<?php echo $store_id?>" value="<?php $var = 'lucid_invoice_logo_'.$store_id; echo $$var; ?>" id="logo_<?php echo $store_id?>" />
                  <br />
                  <a onclick="image_upload('logo_<?php echo $store_id?>', 'thumb-logo_<?php echo $store_id?>');"><?php echo $text_browse; ?></a>
                  </div>
           
              </td>
        </tr>
        <tr>
          <td><?php echo $invoice_details; ?></td>
          <td><textarea type="text" name="lucid_invoice_details_<?php echo $store_id?>"  ><?php $var='lucid_invoice_details_'.$store_id;echo $$var; ?></textarea></td>
        </tr>
        <tr>
          <td><?php echo $invoice_vat; ?></td>
          <?php $var = 'lucid_invoice_vat_'.$store_id ; ?>
          <td><select name="lucid_invoice_vat_<?php echo $store_id?>"  >
              <option value="1" <?php if($$var=="1")echo "SELECTED";?>><?php echo $text_show; ?></option>
              <option value="0" <?php if($$var=="0")echo "SELECTED";?>><?php echo $text_hidden; ?></option>
          </select>
          </td>
        </tr>
      </table>
    </div>
 
 <?php } ?>  
    </form>
    
    <div style="text-align: center;"><a href="http://lucidlogic.co.za/" target="_blank">&copy;Copyright LucidLogic 2012</a>
</div>
    </div>
</div>
<script type="text/javascript"><!--
function image_upload(field, thumb) {

	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script> 
    <?php echo $footer; ?>