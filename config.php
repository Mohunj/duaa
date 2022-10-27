<?php
//read duaa page ID from table wp_duaa

$page_idd = $wpdb->prepare("SELECT duaa_page_id FROM wp_duaa WHERE id = %d", $id);
          $results = $wpdb->get_results( $page_idd);
          foreach ($results as $page_id_last) {
            # code...
            $duaa_id_last= $page_id_last->duaa_page_id;
          }
?>
