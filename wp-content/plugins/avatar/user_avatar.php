<?php
/**
* Plugin Name: User Avatar
* Plugin URI: https://defina.ru/shop/app/WordPress/plugin_wordpress.py
* Description: Гибкая возможность управлять фото профиля
* Version: 1.5.0
* Author: iQs Solution
* Author URI: https://defina.ru
* License: GPL3
*/

/*  Copyright 2018  iQs Solution  (email: work.dev.i@yandex.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define("NO_AVATAR", "images/no-user.jpg");

add_action( 'show_user_profile', 'getFormAvatarUser' );
add_action( 'edit_user_profile', 'getFormAvatarUser' );
add_action( 'personal_options_update', 'saveUserPhoto' );
add_action( 'edit_user_profile_update', 'saveUserPhoto' ); 
add_action( 'admin_enqueue_scripts', 'imageUploader' );
add_filter( 'manage_users_columns', 'addProfilePhotoColumn', 4 );
add_action( 'manage_users_custom_column', 'fillPhotoColumn', 10, 3);
add_action('admin_head', 'userAvatarPlugin');


function getFormAvatarUser($user){
    include 'form.php';
}

function saveUserPhoto($user_id){
	if (!current_user_can('edit_user', $user_id))
		return false;
	update_user_meta($user_id, 'userimg', $_POST['userimg']);
}

function imageUploader() {
    wp_enqueue_media();
    wp_enqueue_script(
        'user-profile-image-uploader',
        plugins_url( '/js/image-uploader.js', __FILE__ ),
        array( 'jquery','media-upload' ), 1.0, true
    );
}

function addProfilePhotoColumn( $columns ){
   $num = 1;
   $new_columns = array(
       'profile_photo' => __('Фото профиля', 'profile-photo'),
   );
   return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}


function fillPhotoColumn( $val, $colname, $user_id )
{
    $default_image = plugins_url(NO_AVATAR, __FILE__);
    $user_img = get_user_meta( $user_id, 'userimg', 1 );

    if( $colname === 'profile_photo' ){
        return '<img src="'.(empty($user_img)? $default_image : $user_img ).'" width="50">'; 
    }
}


function userAvatarPlugin(){
    echo '<link href="'.plugins_url( 'css/avatar.min.css', __FILE__).'" rel="stylesheet" type="text/css">';
}