<?php
class template
{
	function view($view, $data = null)
	{
		$_ci =&get_instance();
		if(is_ajax())
		{
			$_ci->parser->parse($view, $data);
		}
		else
		{
			$return['content'] = $_ci->parser->parse($view, $data, true);
			$_ci->parser->parse('template', $return);
		}
	}

	function view_public($view, $data = null)
	{
		$_ci =&get_instance();
		if(is_ajax())
		{
			$_ci->parser->parse($view, $data);
		}
		else
		{
			$return['content'] = $_ci->parser->view($view, $data, true);
			$_ci->parser->parse('public', $return);
		}
	}
}