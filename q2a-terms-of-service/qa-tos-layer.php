<?php

/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-plugin/mouseover-layer/qa-mouseover-layer.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Theme layer class for mouseover layer plugin


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

class qa_html_theme_layer extends qa_html_theme_base {
	var $jsTOS;
	function doctype(){
		if ($this->template=='register'){
			if( (qa_opt('tos_enable')) && (qa_opt('tos_serverside')==0) ){
				$this->jsTOS=true;
				//var_dump($this->content['form']['fields']['handle']['value']);
				$this->content['form']['buttons']['register']['tags'] .= ' id="register"';
				$TOS = qa_post_text('TOS');
				if (!(empty($this->content['form']['fields']['handle']['value'])) && !(isset($TOS)) )
					$error =  qa_opt('tos_error');
				$this->content['form']['fields']['tos']=array(
						'label' => qa_opt('tos_checkbox_label'),
						'tags' => 'NAME="TOS" ID="TOS"',
						'value' => qa_html(@$TOS),
						'error' => qa_html(@$error),
						'type' => 'checkbox',
				);
				if (!empty(qa_opt('tos_content'))){
					$this->content['form']['fields']['tos_content']=array(
						'tags' => 'NAME="tos_content" ID="tos_content" READONLY',
						'type' => 'textarea',
						'rows' => '6',
						'value' => qa_html(qa_opt('tos_content')),
					);
				}
			}
		}
		qa_html_theme_base::doctype(); 
	}	
	
	function body_script()
	{
		qa_html_theme_base::body_script();
		if($this->jsTOS){
			$error =  qa_opt('tos_error');
			$this->output(
				'<script type="text/javascript">',
				"
				$(document).ready(function(e) {  
					$('#register').click(function() {
						if (jQuery('#TOS').is(':checked')){
							$('.qa-waiting').show();
							$('#TOSvalidation').remove();
						}else{
							$('#TOSvalidation').parent().parent().remove();
							$('#TOS').parent().parent().append( '<tr><td class=\"qa-form-tall-data\"><div id=\"TOSvalidation\" class=\"qa-form-tall-error\">" . $error . "</div></td></tr>' );
							$('.qa-waiting').hide();
							return false;
							e.preventDefault();
						}
					});
				});
				",
				'</script>'
			);
		}
	}
}


/*
	Omit PHP closing tag to help avoid accidental output
*/