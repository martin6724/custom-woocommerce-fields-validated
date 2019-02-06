<?php

/**

* Add custom field to the checkout page

*/

add_action('woocommerce_before_order_notes', 'custom_checkout_field');

function custom_checkout_field($checkout)

{

echo '<div id="custom_checkout_field"><h3>' . __('Student First Name') . '<abbr class="required" title="required">*</abbr></h3>';

woocommerce_form_field('student_first_name', array(

'type' => 'text',

'class' => array(

'my-field-class form-row-wide'

) ,

'label' => __('Student First Name') ,

'placeholder' => __('Student First Name') ,
'required' => 'true'

) ,

$checkout->get_value('student_first_name'));

echo '</div>';

}

add_action('woocommerce_before_order_notes', 'custom_checkout_field2');

function custom_checkout_field2($checkout)

{

echo '<div id="custom_checkout_field2"><h3>' . __('Student Last Name') . '<abbr class="required" title="required">*</abbr></h3>';

woocommerce_form_field('student_last_name', array(

'type' => 'text',

'class' => array(

'my-field-class form-row-wide'

) ,

'label' => __('Student Last Name') ,

'placeholder' => __('Student Last Name') ,
'required' => 'true'

) ,

$checkout->get_value('student_last_name'));

echo '</div>';

}


/**

* Checkout Process

*/

add_action('woocommerce_after_checkout_validation', 'customised_checkout_field_process');

function customised_checkout_field_process()

{

// Show an error message if the field is not set.

if (!$_POST['student_first_name']) wc_add_notice(__('Please enter <strong>Student First Name!</strong>') , 'error');
if (!$_POST['student_last_name']) wc_add_notice(__('Please enter <strong>Student Last Name</strong>!') , 'error');


}

/**

* Update the value given in custom field

*/

add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id)

{

if (!empty($_POST['student_first_name'])) {

update_post_meta($order_id, 'Student First Name',sanitize_text_field($_POST['student_first_name']));

}

if (!empty($_POST['student_last_name'])) {

update_post_meta($order_id, 'Student Last Name',sanitize_text_field($_POST['student_last_name']));

}

}




/**
* Display field value on the order edit page
*/
add_action( ‘woocommerce_admin_order_data_after_billing_address’, ‘my_custom_checkout_field_display_admin_order_meta’, 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
echo '.__(‘student_first_name’).’: ‘ . get_post_meta( $order->get_id(), ‘student_first_name’, true ) . ';
echo '.__(‘student_last_name’).’: ‘ . get_post_meta( $order->get_id(), ‘student_last_name’, true ) . ';
}



?>
