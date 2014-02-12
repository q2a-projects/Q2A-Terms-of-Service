<?php

class qa_tos_admin_form {
	
	function option_default($option)
	{
		switch($option){
			case 'tos_checkbox_label':
				return 'I agree to Terms of Service and Privacy Policy.';
				break;
			case 'tos_error':
				return 'You need to accept Terms of Service to register';
				break;
			default:
				return false;
		}
	}


	function admin_form(&$qa_content)
	{
		$saved=false;
		
		if (qa_clicked('tos_save_button')) {
			qa_opt('tos_enable', (int)qa_post_text('tos_enable'));
			qa_opt('tos_checkbox_label', qa_post_text('tos_checkbox_label'));
			qa_opt('tos_error', qa_post_text('tos_error'));
			qa_opt('tos_content', qa_post_text('tos_content'));
			qa_opt('tos_serverside', (int)qa_post_text('tos_serverside'));
			$saved=true;
		}
		
		qa_set_display_rules($qa_content, array(
			'tos_checkbox_label' => 'tos_enable',
			'tos_content' => 'tos_enable',
			'tos_serverside' => 'tos_enable',
			'tos_static' => 'tos_enable',
			'tos_error' => 'tos_enable',
		));
		qa_set_display_rules($qa_content, array(
			'tos_static' => 'tos_serverside',
		));
		if(qa_opt('tos_serverside'))
			$warning = 'Warning: activating This option overrides PHP file responsible for handling registration page. it\'s tested with Q2A 1.6 but might not work on other versions.';
		else 
			$warning = '';
		return array(
			'ok' => $saved ? 'TOS settings saved' : null,
			
			'fields' => array(
				array(
					'label' => 'Enable Terms of Service on registration form',
					'type' => 'checkbox',
					'value' => qa_opt('tos_enable'),
					'tags' => 'name="tos_enable" id="tos_enable"',
				),
				
				array(
					'id' => 'tos_checkbox_label',
					'label' => 'Terms of Service checkbox label:',
					'type' => 'textarea',
					'rows' => '2',
					'suffix' => 'HTML is enabled, so you can add a link to TOS in this field',
					'value' => qa_opt('tos_checkbox_label'),
					'tags' => 'name="tos_checkbox_label"',
				),
				
				array(
					'id' => 'tos_error',
					'label' => 'Error Message if validation fails',
					'value' => qa_opt('tos_error'),
					'tags' => 'name="tos_error"',
				),
				
				array(
					'id' => 'tos_content',
					'label' => 'Terms of Service content',
					'suffix' => 'you can leave this empty, so textbox with content of Terms of Service won\'t show up.',
					'type' => 'textarea',
					'rows' => '6',
					'value' => qa_opt('tos_content'),
					'tags' => 'name="tos_content"',
				),
				
				array(
					'id' => 'tos_serverside',
					'label' => 'Check validation in server side instead of using JavaScript',
					'type' => 'checkbox',
					'value' => qa_opt('tos_serverside'),
					'tags' => 'name="tos_serverside"',
					'error' => $warning,
				),
			),
			
			'buttons' => array(
				array(
					'label' => 'Save Changes',
					'tags' => 'name="tos_save_button"',
				),
			),
		);
	}
	
}


/*
	Omit PHP closing tag to help avoid accidental output
*/