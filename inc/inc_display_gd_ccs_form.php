<?php
function display_gd_ccs_form($atts) {
	global $wpdb;
	
	if($atts[contactlist]!=""){$list=$atts[contactlist];}else{$list=get_option('gd_ccs_defaultlist');}

	if($_POST['action']=="cc_addcontact"){

	$email=$_POST['gd_ccs_email'];
	$fname=$_POST['gd_ccs_fname'];
	$lname=$_POST['gd_ccs_lname'];
	
	$cc_UN=get_option('gd_ccs_username');
	$cc_PW=get_option('gd_ccs_passwd');
	$cc_Key=get_option('gd_ccs_apikey');
	
	$entry = "<entry xmlns=\"http://www.w3.org/2005/Atom\">
	  <title type=\"text\"> </title>
	  <updated>".date('c')."</updated>
	  <author></author>
	  <id>data:,none</id>
	  <summary type=\"text\">Contact</summary>
	  <content type=\"application/vnd.ctct+xml\">
	    <Contact xmlns=\"http://ws.constantcontact.com/ns/1.0/\">
	      <EmailAddress>$email</EmailAddress>
	      <FirstName>$fname</FirstName>
	      <LastName>$lname</LastName>
	      <OptInSource>ACTION_BY_CONTACT</OptInSource>
	      <ContactLists>
	        <ContactList id=\"http://api.constantcontact.com/ws/customers/$cc_UN/lists/$list\" />
	      </ContactLists>
	    </Contact>
	  </content>
	</entry>";
	
	// Initialize the cURL session
	$request ="https://api.constantcontact.com/ws/customers/$cc_UN/contacts";
	$session = curl_init($request);
	
	// Set up digest authentication
	$userNamePassword = $cc_Key . '%' . $cc_UN . ':' . $cc_PW ;
	
	// Set cURL options
	curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($session, CURLOPT_USERPWD, $userNamePassword);
	curl_setopt($session, CURLOPT_POST, 1);
	curl_setopt($session, CURLOPT_POSTFIELDS , $entry);
	curl_setopt($session, CURLOPT_HTTPHEADER, Array("Content-Type:application/atom+xml"));
	curl_setopt($session, CURLOPT_HEADER, false); // Do not return headers
	curl_setopt($session, CURLOPT_RETURNTRANSFER, 1); // If you set this to 0, it will take you to a page with the http response
	
	// Execute cURL session and close it
	$response = curl_exec($session);
	curl_close($session);

	return get_option('gd_ccs_successmessage');

	}else{
	

$ccs_default_output="<div id='gd-ccs-form-wrapper'>";
$ccs_default_output.="<p>".get_option('gd_ccs_subscribemessage')."</p>";
$ccs_default_output.="<form method='post'>";
$ccs_default_output.="<input type='hidden' name='action' value='cc_addcontact' />";
$ccs_default_output.="<table>";
$ccs_default_output.="<tr><td class='label'>Email</td><td class='input'><input type='text' name='gd_ccs_email' value='' /></td></tr>";
$ccs_default_output.="<tr><td class='label'>First Name</td><td class='input'><input type='text' name='gd_ccs_fname' value='' /></td></tr>";
$ccs_default_output.="<tr><td class='label'>Last Name</td><td class='input'><input type='text' name='gd_ccs_lname' value='' /></td></tr>";
$ccs_default_output.="<tr><td class='submit' colspan='2'><input type='submit' value='Subscribe' /></td></tr>";
$ccs_default_output.="</table></form>";
$ccs_default_output.="<div style='clear:both;'></div></div>";

return $ccs_default_output;

	}

} 
