<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=164953673597818";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<h1>In Twitter</h1>

Firstly! <b>Thank you</b> for downloading my plugin. Enjoy! <br><br>

<h2>Installation Instructions</h2>

1. Activate Plugin.<br>

2. Go to Settings>> In Twitter<br>

3. Enter your Username(dont need the &#64; symbol as its already included), height(standard height is 211), how many twitter feeds you want displayed, title, caption, border colour and the background colour you would like.<br>

4.  Press "Update" <br>

5. Go to Appearance >> Widgets >> and place the widget into the sidebar.

<b>PS.  Make sure you enter a height and twitter feed number below; otherwise the plugin will not work!</b><br>

Please feel free to comment or ask questions about this plugin <a href="http://www.iannash.com/intwitter/">here</a>. <br>

<div class="fb-like" data-href="http://www.iannash.com/intwitter/" data-send="false" data-width="450" data-show-faces="false"></div><br><br>

<?PHP

	add_option( 'intwitter_uid', '', 'Twitter user name', 'yes' );
	add_option( 'intwitter_userid', '', 'Twitter User ID', 'yes' );
	add_option( 'intwitter_height', '', 'Twitter height', 'yes' );
	add_option( 'intwitter_width', '', 'Twitter width', 'yes' );
	add_option( 'intwitter_twitfeed', '', 'Twitter feed', 'yes' );
	add_option( 'intwitter_twitbg', '', 'Twitter bg color', 'yes' );
	add_option( 'intwitter_twitborder', '', 'Twitter border color', 'yes' );
	add_option( 'intwitter_twittitle', '', 'Twitter title', 'yes' );
	add_option( 'intwitter_cap', '', 'Twitter title caption', 'yes' );
	
	function intwitter_options_page() {
	global $wpdb;
	$table_name = "intwitter";
	$username = get_option( 'intwitter_uid' );
	$username = get_option( 'intwitter_userid' );
	$height = get_option( 'intwitter_height' );
	$height = get_option( 'intwitter_width' );
	$twitbg = get_option( 'intwitter_twitbg' );
	$twitborder = get_option( 'intwitter_twitborder' );
	$twitfeed = get_option( 'intwitter_twitfeed' );
	$twitfeed = get_option( 'intwitter_twittitle' );
	$twitfeed = get_option( 'intwitter_cap' );
	$submitFieldID = 'intwitter_submit_hidden';
	if ( $_POST[ $submitFieldID ] == 'Y' ) {
		update_option( 'intwitter_uid', $_POST[ 'intwitter_form_username' ] );
		update_option( 'intwitter_uid', $_POST[ 'intwitter_form_userID' ] );
		update_option( 'intwitter_height', $_POST[ 'intwitter_form_height' ] );
		update_option( 'intwitter_width', $_POST[ 'intwitter_form_width' ] );
		update_option( 'intwitter_twitfeed', $_POST[ 'intwitter_form_feed' ] );
		update_option( 'intwitter_twittitle', $_POST[ 'intwitter_form_title' ] );
		update_option( 'intwitter_cap', $_POST[ 'intwitter_form_cap' ] );
		update_option( 'intwitter_twitbg', $_POST[ 'intwitter_form_twitbg' ] );
		update_option( 'intwitter_twitborder', $_POST[ 'intwitter_form_twitborder' ] );
	?>
		<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
	<?php	} ?>
	
<?php } ?>

	<form name="intwitter_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">
		<input type="hidden" name="intwitter_submit_hidden" value="Y">
		<p>
			<h3>Username</h3>
			&#64;<input type="text" name="intwitter_form_username" value="<?php echo ( get_option ( 'intwitter_uid' ) ); ?>">
			
			<h3>User ID</h3>
			<input type="text" name="intwitter_form_userID" value="<?php echo ( get_option ( 'intwitter_userid' ) ); ?>">
			
			<h3>Height (in px)</h3> NOTE: The minimum height is 200px.<br>
			<input type="text" name="intwitter_form_height" value="<?php echo ( get_option ( 'intwitter_height' ) ); ?>">
			
			<h3>Width (in px - usually about 300px)</h3>Your theme may override this. The minimum width of a timeline is 180px and the maximum is 520px.<br>
			<input type="text" name="intwitter_form_width" value="<?php echo ( get_option ( 'intwitter_width' ) ); ?>">
			
			<h3>Feed Number</h3>
			<input type="text" name="intwitter_form_feed" value="<?php echo ( get_option ( 'intwitter_twitfeed' ) ); ?>">
			
			<!--<h3>Title</h3>
			<input type="text" name="intwitter_form_title" value="<?php echo ( get_option ( 'intwitter_twittitle' ) ); ?>">
			
			<h3>Caption</h3>
			<input type="text" name="intwitter_form_cap" value="<?php echo ( get_option ( 'intwitter_cap' ) ); ?>">

			<h3>Twitter Background Color(in hexadezimal eg: 3F3 or 33FF33)</h3> 
			#<input type="text" name="intwitter_form_twitbg" value="<?php echo ( get_option ( 'intwitter_twitbg' ) ); ?>">-->
			
			<h3>Twitter Border Color(in hexadezimal eg: 3F3 or 33FF33)</h3> 
			#<input type="text" name="intwitter_form_twitborder" value="<?php echo ( get_option ( 'intwitter_twitborder' ) ); ?>">
			
			<p class="submit"><input type="submit" name="Submit" value="<?php _e( 'Update', 'mt_trans_domain' ) ?>"></p>
			
		</p>
	</form>

<?php	



mysql_select_db($wpdb);

if(isset($_POST['Submit'])){
	$Submit=$_POST['intwitter_form_username'];
	
	//Enter the first line
	$updateid="INSERT INTO intwitter VALUE(1,userid)";
	mysql_query($updateid);
	
	//Update the field
	$query="UPDATE intwitter SET userid='$Submit' WHERE id='1'";
	mysql_query($query);
	//var_dump(mysql_error());
	//Run the query
	//mysql_query($query) or die("Failed to update");
	//update the userid
	update_option( 'intwitter_uid', $_POST[ 'intwitter_form_username' ] );
	update_option( 'intwitter_userid', $_POST[ 'intwitter_form_userID' ] );
	update_option( 'intwitter_height', $_POST[ 'intwitter_form_height' ] );
	update_option( 'intwitter_width', $_POST[ 'intwitter_form_width' ] );	
	update_option( 'intwitter_twitfeed', $_POST[ 'intwitter_form_feed' ] );
	update_option( 'intwitter_twittitle', $_POST[ 'intwitter_form_title' ] );
	update_option( 'intwitter_cap', $_POST[ 'intwitter_form_cap' ] );
	update_option( 'intwitter_twitbg', $_POST[ 'intwitter_form_twitbg' ] );
	update_option( 'intwitter_twitborder', $_POST[ 'intwitter_form_twitborder' ] );
	?>
	<div class="updated"><p><strong><?php _e('Option saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?PHP
}





?>
<br>
This is my first wordpress plugin which I made in my own personal time.<br>
If you feel like donating to my plugin, please do so here: <form action="https://www.paypal.com/cgi-bin/webscr" method="post"><div class="paypal-donations"><input type="hidden" name="cmd" value="_donations" /><input type="hidden" name="business" value="ian.nash@gmail.com" /><input type="hidden" name="currency_code" value="AUD" /><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online." /><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" /></div></form>