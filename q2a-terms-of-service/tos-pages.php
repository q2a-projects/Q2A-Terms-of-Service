<?php

	function qa_page_routing()
	{
		$pages = qa_page_routing_base();
		if (qa_opt('tos_serverside'))
			$pages['register'] = '../qa-plugin/q2a-terms-of-service/qa-page-register.php'; // changed to include a new file instead of default page
		return $pages;
	}


/*
	Omit PHP closing tag to help avoid accidental output
*/