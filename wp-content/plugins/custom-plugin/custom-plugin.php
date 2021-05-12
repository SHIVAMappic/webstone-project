<?php
/*
Plugin Name:Custom Plugin
Plugin URI:http://www.google.com
Author:Shivam Chouhan
Author URI:http://www.google.com
Description:Basic Custom Plugin Development
Version:1.1.1
Text Domain:custom-plugin
*/

define('CUSTOM_PLAGIN_PATH',plugin_dir_path(__FILE__));
define('CUSTOM_PLAGIN_URL',plugin_dir_url(__FILE__));

function custom_plugin_admin_menu_submenu() {
	add_menu_page(
		'Custom Plugin',  // page title
		'Membership',              // Menu title/label
		'manage_options',       // capabiltiy
		'membership-plugin',  // menu-slug(unique)
		'list_membership_emails', // callback function 
		'',                      // icons
		6                        // position
	);
	
	add_submenu_page(
		'membership-plugin',  // parent-slug
		'All Emails',  // Page title
		'All Emails',             // menu label
		'manage_options',       // capability
		'membership-plugin',  // menu slug
		'list_membership_emails'  // callback function
	);
	
	add_submenu_page(
		'membership-plugin',
		'Add Membership',
		'Add Email',
		'manage_options',
		'add-membership-email',
		'add_membership_email'
	);
}
add_action('admin_menu','custom_plugin_admin_menu_submenu');


// admin assets files
function custom_plugin_admin_assets(){
	wp_enqueue_style('admin-bootstrap-css',plugins_url('assets/bootstrap/css/bootstrap.min.css',__FILE__),array(),'');	
	wp_enqueue_script('admin-bootstrap-js',plugins_url('assets/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'),'',true);	
	wp_localize_script('admin-custom-ajax','ajaxurl_object',array('ajaxurl'=>admin_url('admin-ajax.php')));	
}
add_action('admin_enqueue_scripts','custom_plugin_admin_assets');

// front assets files
function custom_plugin_front_assets(){
	wp_enqueue_style('front-bootstrap-css',plugins_url('/assets/bootstrap/css/bootstrap.min.css',__FILE__));
	wp_enqueue_script('front-bootstrap-js',plugins_url('/assets/bootstrap/css/bootstrap.min.css',__FILE__),array('jquery'),'',true);	
}
add_action('wp_enqueue_scripts','custom_plugin_front_assets');


function list_membership_emails(){	
	require plugin_dir_path( __FILE__ ) .'/views/admin/email_list.php';
}

function add_membership_email(){
	require plugin_dir_path( __FILE__ ) .'/views/admin/add_email.php';
}

// add email shortcode for front
function user_signup_email(){
	require plugin_dir_path( __FILE__ ) .'/views/front/add_email.php';	
}
add_shortcode('user_signup_email_shortcode','user_signup_email');

// Add And Edit Email

function EmailRegister(){
	global $wpdb;
	$postData=$_POST;
    if(isset($postData) && !empty($postData) && $_SERVER['REQUEST_METHOD'] === 'POST'){
		
		if($postData['useraction'] == 'edit' && !empty($postData['userid'])){
			$rows = $wpdb->get_row("SELECT user_email FROM wp_users  WHERE user_email = '".$_POST['email']."'  and id != '".$postData['userid']."'", ARRAY_A);
			if($rows){
				$output['success'] =  false;
				$output['message'] = 'Email Already exists!';				
			}else{
				wp_update_user( array( 'ID' => $postData['userid'], 'user_email' => esc_attr( $_POST['email'] ) ) );
				$output['success'] = true;
				$output['message'] = 'Email  updated successfully!';
			}		
		}else{
			$password = substr(md5(mt_rand()), 0, 15);	 
			$userdata = array(
				'user_login'=>$_POST['email'],
				'user_pass'=>$password,
				'user_email'=>$_POST['email'],		
				'role'=>'subscriber'
			);	
			if(email_exists($userdata['user_email'])){
				$output['success'] =  false;
				$output['message'] = 'Email Already exists!';
			}else{	
				$user_id = wp_insert_user($userdata);		
				if(!is_wp_error($user_id)){
					$output['success'] = true;
					$output['message'] = 'Email  added successfully!';
				}else{
					$output['success'] = false;
					$output['message'] = 'Something went wrong.Try agian!';
				}
			}			
		}
		
		$result=array('success'=>$output['success'],'message'=> $output['message']);
        echo json_encode($result);exit;
	}	
}
add_action('wp_ajax_EmailRegister','EmailRegister');
add_action('wp_ajax_nopriv_EmailRegister','EmailRegister');


//  Delete Email
function deleteEmail(){
	global $wpdb;
	$postData=$_POST;
    if(isset($postData) && !empty($postData) && $_SERVER['REQUEST_METHOD'] === 'POST'){
		wp_delete_user( $postData['userid'] );
		$output['success'] = true;
		$output['message'] = 'Email  deleted successfully!';
		$result=array('success'=>$output['success'],'message'=> $output['message']);
        echo json_encode($result);exit;
	}	
}
add_action('wp_ajax_deleteEmail','deleteEmail');
add_action('wp_ajax_nopriv_deleteEmail','deleteEmail');

// check membrship user exist or not 
function checkEmail(){
	global $wpdb;
	$postData=$_POST;
    if(isset($postData) && !empty($postData) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    	if(email_exists($postData['email'])){
				$output['success'] =  true;
				$output['message'] = 'Contribute a minimum of $10 to receive your official membership card!';
		}else{				
				$output['success'] = false;
				$output['message'] = 'Sign up here and make a donation to become a member';				
		}		
		$result=array('success'=>$output['success'],'message'=> $output['message']);
        echo json_encode($result);exit;		
	}	
}
add_action('wp_ajax_checkEmail','checkEmail');
add_action('wp_ajax_nopriv_checkEmail','checkEmail');

