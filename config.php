<?php
//read duaa page ID from table wp_duaa

$page_id= $wpdb->query($wpdb->prepare("SELECT 'duaa_page_id' FROM 'wp_duaa'"));

//print ($page_id);

?>
