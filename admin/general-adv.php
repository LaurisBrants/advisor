<?php
global $wpdb;
$request = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}adv_table");
$count = count($request);
echo '<h1>General Options</h1>';
echo '<div class="importer-dash-container">';
    echo '<div class="importer-dash-wrapper">';
        echo '<div class="importer-info-box">';
            echo '<h2 class="importer-h importer-g">Records in table</h2>';
            echo '<strong class="importer-counter">'.$count.'</strong>';
        echo '</div>';

        echo '<div class="importer-info-box">';
            echo '<h2 class="importer-h importer-o">Table Last Updated</h2>';
            echo '<strong>'.get_option( 'adv_date', true ).'</strong>';
        echo '</div>';

        echo '<div class="importer-info-box">';
            echo '<h2 class="importer-h importer-o">Shortcode</h2>';
            echo '<strong>[advisor]</strong>';
        echo '</div>';
        
    echo '</div>';
    echo '<a href="#" id="clearer">Clear Table</a>';
echo '</div>';
echo '<div id="response"></div>';
?>
<script>
jQuery('#clearer').on('click',function(){
			
		jQuery.ajax({
		type: 'POST',
        url: '/wp-admin/admin-ajax.php', 
        data: {
            'action':'advAjaxClear',
        },
        success:function(data) {
            console.log(data);
            jQuery('#response').html('<h3>Table Cleared</h3>');
            jQuery('.importer-counter').text('0');
        },  
        error: function(errorThrown){
            console.log(errorThrown);
            jQuery('#response').html('<h3>There is an error: </h3>'+errorThrown);
        }
    });   
	});
</script>