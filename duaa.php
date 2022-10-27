<?php
/*
plugin name:ادعية الصحيفة السجادية
plugin URI:https://iiq.epizy.com
Author:Mohammed Hussen najeeb
Author URI:https://iiq.epizy.com
Description: This daily duaa for all Muslims.head to the admin duaa submenu
and put the page ID and press the button.

*/

/*you should create page , name it 'duaa'
vars
*/
/**
 * Registers a stylesheet.
 */
function wpdocs_register_plugin_styles() {
	wp_register_style( 'style', plugins_url('duaa-1/css/style.css') );
	wp_enqueue_style('style');
}
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'wpdocs_register_plugin_styles' );

//end register

add_action('the_content','get_duaa');
function get_duaa(){
          global $wpdb;
          $id=date("w");
          $table="wp_duaa";
          require "config.php";
 
         if ( is_page($duaa_id_last) )  {
       
         $sql = "SHOW TABLES LIKE '".$table."'";

         if($wpdb->get_var($sql)){
           
         $query="SELECT * FROM ".$table." "."WHERE ID = %d";
      $duaa_result=$wpdb->get_results($wpdb->prepare($query,$id));
          foreach ($duaa_result as $key=>$val) {
          echo "<br />";
          ?>
<div class="d-flex align-items-center ml-4">
    <p class="duaa_title">
<?php 
          echo "دعاء يوم ".$val->day;
          
          ?></p><?php
          ?></div><?php 
          echo "<br />";
          ?><p class="duaa_text"><?php
        echo nl2br(htmlspecialchars($val->duaa_text)); ?></p><?php

          }
       }else{
       $path="inc/index.php";
	   require $path;
        }
       }else{
          echo get_the_content();
     }

   }


add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('Duaa page configs', 'duaa page configs', 'manage_options', 'plugin', 'plugin_options_page');
}

function plugin_options_page() {
   global $wpdb;
?>
<div>
<h2>Specify Duaa page  id</h2>
Options relating to duaa plugin.
<form action="#" method="post">
<label for="page_id">page ID --- </label>
<input name="duaa_page_id" />
<br />
<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
</form>
<?php if(! empty ($_POST["duaa_page_id"])):?>
<?php
$duaa_page_id= $_POST["duaa_page_id"];
$update1 = $wpdb->query($wpdb->prepare("UPDATE wp_duaa SET duaa_page_id= %d","$duaa_page_id"));
if($update1){
   echo " Updated Successfully !!";
}else{
   echo "There is an error";
}
?><br />
<?php endif;?>
<?php
}

?>
  
 

