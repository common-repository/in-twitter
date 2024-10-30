<?php
/*
Plugin Name:In Twitter
Plugin URI: http://www.iannash.com/intwitter
Description: Twitter Widget. This is a very simple and clean Twitter Plugin. The client must have internet access for this plugin to work.
Version: 3.4
Author: Ian Nash
Author URI: http://www.iannash.com/intwitter
License: GPL2
*/


/*  Copyright 2012  Ian Nash (email : iannash.com/intwitter)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


register_activation_hook( __FILE__, 'intwitter_install' );


add_action('wp_head', 'twitter_head_scripts');
function twitter_head_scripts() {
        echo '<script type="text/javascript" src="http://widgets.twimg.com/j/2/widget.js"></script>'."\n";
        // Check if jQuery is already loaded
        if (jQuery) {
                // If jQuery is loaded already
                echo "<!-- Jquery Already Loaded -->";
        } else {
                // jQuery is not loaded
                echo "<!-- Jquery being loaded from IN-Twitter Already Loaded -->";
                echo "<script type='text/javascript' src='" . plugins_url() . "/in-twitter/jquery-1.7.1.min.js'></script>"."\n";
        }

        //echo "<link rel='stylesheet' type='text/css' href='" . plugins_url() . "/in-twitter/intwitter.widget.css' media='all'/>"."\n";
        //echo "<style>.twtr-widget-profile img.twtr-profile-img{display:none!important; } .twtr-widget-profile h3, .twtr-widget-profile h4{position:relative;} .twtr-hd{ padding:5px!important;}</style>"."\n";
		
}
	
// create the admin page
add_action('admin_menu', 't_add_admin_menu');

function t_add_admin_menu() {
// add an options page for the plugin
	add_options_page('In Twitter', 'In Twitter', 'manage_options', 'twitter', 't_plugin_options');
}

function t_plugin_options(){
	// include the plugin admin page
	require_once('twitter_admin.php');
}

//Install the intwitter database
function intwitter_install() {

	global $wpdb;
	$table_name = "intwitter";
	
	intwitter_db_drop_table();

   	if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
		$sql = "CREATE TABLE " . $table_name . " (
	 	 id INT NOT NULL,
	 	 userid VARCHAR(200) NOT NULL,
		 twitheight INT,
		 twitfeed INT,
		 twitbg INT,
		 twitborder INT,
		 twittitle INT,
		 twitcap VARCHAR(200),
	 	 PRIMARY KEY(id)
		);";

		add_option( "twitter_db_version", "2.0" );
	}
}


//Delete intwitter table
function intwitter_db_drop_table() {
	global $wpdb;
	$table_name = "intwitter";
   	if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
		$sql = "DROP TABLE " . $table_name;
	}
}

//Widget creation
function widget_intwitter() {
?>

	<?PHP

echo "<a class='twitter-timeline'";
echo "' width='";
echo ( get_option ( 'intwitter_width' ) );
echo "' height='";
echo ( get_option ( 'intwitter_height' ) ); 
echo "' href='https://twitter.com/twitterapi' ";
echo " data-widget-id='";
echo ( get_option ( 'intwitter_userid' ) );
echo "' data-border-color='";
echo ( get_option ( 'intwitter_twitborder' ) );
echo "' data-tweet-limit='";
echo ( get_option ( 'intwitter_twitfeed' ) );
echo "'>Tweets by ";
echo ( get_option ( 'intwitter_uid' ) );
echo "</a>";
echo "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>";

	
	
//echo "<script>new TWTR.Widget({  version: 2,  type: 'profile',  rpp: ";
//echo ( get_option ( 'intwitter_twitfeed' ) );
//echo ",  interval: 30000,  width: 196,  height: ";
//echo ( get_option ( 'intwitter_height' ) );  
//echo",  theme: {    shell: {      background: '#";
//echo ( get_option ( 'intwitter_twitborder' ) ); 
//echo " ', color: '#ffffff' },    tweets: {  background: '#";
//echo ( get_option ( 'intwitter_twitbg' ) ); 
//echo " ', color: '#000000', links: '#094F95' } }, features: { scrollbar: false, loop: false, live: false, behavior: 'all'}}).render().setUser('";
//echo ( get_option ( 'intwitter_uid' ) ); 
//echo "').start();</script>"; ?>

<?php
}
 
function intwitter_init()
{
  register_sidebar_widget(__('IN Twitter'), 'widget_intwitter');
}
add_action("plugins_loaded", "intwitter_init");


?>