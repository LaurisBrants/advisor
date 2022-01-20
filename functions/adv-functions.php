<?php
function advAjaxRequestHandler(){
    global $wpdb;
    $result = $_POST['result'];
    $gender = $_POST['gender'];
    $skill = $_POST['skill'];
    $size = $_POST['size'];
    $category = $_POST['category'];
    
    $wh = round(($result*2),-3)/2;
    
    $question = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}adv_table WHERE `category` LIKE '$category' AND `skill` LIKE '$skill' AND `gender` LIKE '$gender' AND `footsize` LIKE '$size' AND `wh_product` LIKE '$wh'", OBJECT );
   // echo $wpdb->last_query;
    //echo $wh. '-'.$gender.'-'.$skill.'-'.$size;
    //var_dump($question);
    if($question):
        echo '<div><span>Yoru advisor is: '.$question[0]->advisor.'</span> <a href="'.get_the_permalink($question[0]->product_id).'" class="product-target">Go To Your Product</a></div>';
    else:
        echo '<div"><span>Sorry there was no product available for such parameters.</span></div>';
    endif;
    echo '<style>#call_changer{height: 50px;text-align: center;text-transform: uppercase;border: 1px solid;display:flex;justify-content: center;align-items: center;}';
    
    
    die();
}

add_action('wp_ajax_nopriv_advAjaxRequestHandler', 'advAjaxRequestHandler');
add_action('wp_ajax_advAjaxRequestHandler', 'advAjaxRequestHandler');


function advAjaxClearHandler(){
    global $wpdb;
        $table  = $wpdb->prefix . 'adv_table';
        $delete = $wpdb->query("TRUNCATE TABLE $table");
    die();
}
add_action('wp_ajax_advAjaxClear','advAjaxClearHandler');