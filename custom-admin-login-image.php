<?php
  
	/*
		Plugin Name: Custom Admin Login Image
		Plugin URI:  http://www.selfdesigns.co.uk
		Description: Upload your own custom image to display on the admin login page.
		Version:     1.0.0
		Author:      Lewis Self
		Author URI:  http://www.selfdesigns.co.uk
	*/

	if(!defined('ABSPATH')) // Prevent data leaks: http://docs.woothemes.com/document/create-a-plugin/
	{
		exit;
	}

  function cali_customizer_fields($wp_customize)
  {
    $wp_customize->add_setting('login_site_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'login_site_logo', array(
      'label'       => 'Admin Login Logo',
      'section'     => 'title_tagline',
      'description' => 'Recommended width: (620px x 150px)',
      'priority'    => 25,
      'settings'    => 'login_site_logo'
    )));
  }
  add_action('customize_register', 'cwli_customizer_fields');

	function cali_custom_login_image() // https://wordpress.org/support/topic/change-login-picture
	{
		$login_logo = get_theme_mod('login_site_logo');

		if($login_logo)
		{
			$login_logo_size = getimagesize($login_logo);

			echo '<style>
              #login h1 a
              {
                width:' . $login_logo_size[0] . 'px;
                height:' . $login_logo_size[1] . 'px;
                background-image:url("' . $login_logo . '");
                background-size:100%;
              }
            </style>';
		}
	}
	add_action('login_head', 'cwli_custom_login_image');
  
?>