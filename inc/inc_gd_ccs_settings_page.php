<?php

function gd_ccs_settings_page() {

include("class.cc.php");
$un=get_option('gd_ccs_username');
$pw=get_option('gd_ccs_passwd');

$cc = new cc($un,$pw);
	// if you do not want to view the special lists such as do-not-mail set the second parameter to 3
	$lists = $cc->get_all_lists('lists', 3);


?>
<div class="wrap">
<h2>GD Constant Contact Shortcodes Settings</h2>


<p>Before using this plugin, make sure the correct information is listed in the fields below and paste the appropriate shortcodes into the appropriate pages as indicated.</p>

<p>Have fun using this plugin and if you have any questions, requests, or positive feedback, we would love to hear from you at <a href="http://www.guilddev.com/wordpress-plugins/" target="_blank">Guild Development, LLC</a></p>


<form method="post" action="options.php">
    <?php settings_fields('gd_ccs_options_group'); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Constant Contact Username</th>
        <td><input type="text" name="gd_ccs_username" value="<?php echo get_option('gd_ccs_username'); ?>" size="80" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Constant Contact Password</th>
        <td><input type="text" name="gd_ccs_passwd" value="<?php echo get_option('gd_ccs_passwd'); ?>" size="80" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Constant Contact API Key</th>
        <td><input type="text" name="gd_ccs_apikey" value="<?php echo get_option('gd_ccs_apikey'); ?>" size="80" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Subscribe Message</th>
        <td><textarea name="gd_ccs_subscribemessage" rows="3" cols="80"><?php echo get_option('gd_ccs_subscribemessage'); ?></textarea></td>
        </tr>

        <tr valign="top">
        <th scope="row">Success Message</th>
        <td><textarea name="gd_ccs_successmessage" rows="3" cols="80"><?php echo get_option('gd_ccs_successmessage'); ?></textarea></td>
        </tr>

        <tr valign="top">
        <th scope="row">Default Contact List</th>
        <td>
        <select name="gd_ccs_defaultlist">
		<?php
			
			if($lists){
				foreach($lists as $k => $v){
					if(get_option('gd_ccs_defaultlist')==$v['id']){$sel="selected='selected'";}else{$sel="";}
					echo "<option value='{$v['id']}' $sel>List {$v['id']}: {$v['Name']}</option>";
				}
			}
		
		?>
        <?php echo get_option('gd_ccs_defaultlist'); ?>
        </select><br />For the form used to add a contact to the Default Contact List, use this shortcode: <strong>[gd-ccsform]</strong>
        </td>
        </tr>
	



    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>

<h2>Lists</h2>
<?php
$cc = new cc($un,$pw);
	// if you do not want to view the special lists such as do-not-mail set the second parameter to 3
	$lists = $cc->get_all_lists('lists', 3);
	
	if($lists){
		foreach($lists as $k => $v){
			echo "<p>List {$v['id']}: {$v['Name']} - shortcode: <strong>[gd-ccsform contactlist=\"{$v['id']}\"]</strong></p>";
		}
	}

?>


</div>
<?php }
