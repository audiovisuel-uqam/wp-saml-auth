<?php

add_action( 'wp_enqueue_scripts', 'samltheme_parent_theme_enqueue_styles' );

function samltheme_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'twentysixteen-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'samltheme-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'twentysixteen-style' )
    );

}


function samltheme_filter_option( $value, $option_name ) {
    $defaults = array(
        /**
         * Path to SimpleSAMLphp autoloader.
         *
         * Follow the standard implementation by installing SimpleSAMLphp
         * alongside the plugin, and provide the path to its autoloader.
         * Alternatively, this plugin will work if it can find the
         * `SimpleSAML_Auth_Simple` class.
         *
         * @param string
         */
        'simplesamlphp_autoload' =>  $_SERVER['DOCUMENT_ROOT'] . '/private/simplesamlphp/lib/_autoload.php',
        /**
         * Authentication source to pass to SimpleSAMLphp
         *
         * This must be one of your configured identity providers in
         * SimpleSAMLphp. If the identity provider isn't configured
         * properly, the plugin will not work properly.
         *
         * @param string
         */
        'auth_source'            => 'example-userpass',
        /**
         * Whether or not to automatically provision new WordPress users.
         *
         * When WordPress is presented with a SAML user without a
         * corresponding WordPress account, it can either create a new user
         * or display an error that the user needs to contact the site
         * administrator.
         *
         * @param bool
         */
        'auto_provision'         => true,
        /**
         * Whether or not to permit logging in with username and password.
         *
         * If this feature is disabled, all authentication requests will be
         * channeled through SimpleSAMLphp.
         *
         * @param bool
         */
        'permit_wp_login'        => false,
        /**
         * Attribute by which to get a WordPress user for a SAML user.
         *
         * @param string Supported options are 'email' and 'login'.
         */
        'get_user_by'            => 'email',
        /**
         * SAML attribute which includes the user_login value for a user.
         *
         * @param string
         */
        'user_login_attribute'   => 'uid',
        /**
         * SAML attribute which includes the user_email value for a user.
         *
         * @param string
         */
        'user_email_attribute'   => 'mail',
        /**
         * SAML attribute which includes the display_name value for a user.
         *
         * @param string
         */
        'display_name_attribute' => 'display_name',
        /**
         * SAML attribute which includes the first_name value for a user.
         *
         * @param string
         */
        'first_name_attribute' => 'first_name',
        /**
         * SAML attribute which includes the last_name value for a user.
         *
         * @param string
         */
        'last_name_attribute' => 'last_name',
        /**
         * Default WordPress role to grant when provisioning new users.
         *
         * @param string
         */
        'default_role'           => get_option( 'default_role' ),
    );
    $value = isset( $defaults[ $option_name ] ) ? $defaults[ $option_name ] : $value;
    return $value;
}
add_filter( 'wp_saml_auth_option', 'samltheme_filter_option', 10, 2 );
