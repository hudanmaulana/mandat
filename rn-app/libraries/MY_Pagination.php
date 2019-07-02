<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class MY_Pagination extends CI_Pagination {

	public function getPagination($url, $num_rows, $limit, $uri)
	{		
		// config pagination
		$config['base_url'] 			= $url;
		$config['total_rows'] 			= $num_rows;
		$config['per_page'] 			= $limit;
		$config['uri_segment'] 			= $uri;
		$config['first_link'] 			= 'First';
		$config['next_link'] 			= '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] 			= '<i class="fa fa-chevron-left"></i>';
		$config['last_link'] 			= 'Last';
		$config['full_tag_open']		= '<ul class="pagination justify-content-center pagination-sm">';
		$config['full_tag_close']		= '</ul>';
		$config['first_tag_open']		= '<li class="page-item">';
		$config['first_tag_close']		= '</li>';
		$config['last_tag_open']		= '<li class="page-item">';
		$config['last_tag_close']		= '</li>';
		$config['first_url']			= ''; // Alternative URL for the First Page.
		$config['cur_tag_open']			= '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close']		= '</a>';
		$config['next_tag_open']		= '<li class="page-item">';
		$config['next_tag_close']		= '</li>';
		$config['prev_tag_open']		= '<li class="page-item">';
		$config['prev_tag_close']		= '</li>';
		$config['num_tag_open']			= '<li class="page-item">';
		$config['num_tag_close']		= '</li>';
		$config['page_query_string']	= FALSE;
		$config['query_string_segment'] = 'per_page';
		$config['display_pages']		= TRUE;
		$config['_attributes'] 			= 'class="page-link"';

		return $config;
	}
}
// END Pagination Class

/* End of file Pagination.php */
/* Location: ./system/libraries/Pagination.php */