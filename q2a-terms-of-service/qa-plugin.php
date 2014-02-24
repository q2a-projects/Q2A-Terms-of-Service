<?php

/*
	Plugin Name: Terms of Service
	Plugin URI: https://github.com/Towhidn/Q2A-Terms-of-Service
	Plugin Update Check URI: https://github.com/Towhidn/Q2A-Terms-of-Service/master/qa-plugin.php
	Plugin Description: Admin can add "Term of Service" or "Terms & Condition" to registration page
	Plugin Version: 1.0.1
	Plugin Date: 2014-02-11
	Plugin Author: QA-Themes.com
	Plugin Author URI: http://QA-Themes.com
	Plugin License: Copylefted
	Plugin Minimum Question2Answer Version: 1.6
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}


	qa_register_plugin_layer('qa-tos-layer.php', 'TOS Layer');
	qa_register_plugin_module('module', 'qa-tos-admin-form.php', 'qa_tos_admin_form', 'TOS Admin Layer');
	qa_register_plugin_overrides('tos-pages.php');

/*
	Omit PHP closing tag to help avoid accidental output
*/