<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| option name
*/
if ( ! function_exists('opname'))
{
    function opname($str){
        $ci = get_instance();

        $return = $ci->db->get_where(options, array('name' => $str))->row()->value;

        return $return;
    }
}

/*
| active menu
*/
if ( ! function_exists('active_menu'))
{
	function active_menu($class, $function = null, $id = null){
		$ci = get_instance();
		$_class = $ci->uri->segment(1);
		$_function = $ci->uri->segment(2);
		$_id = $ci->uri->segment(3);

		if(@$id AND $_class == $class AND $function == $_function AND $_id == $id)
			return 'active';
		elseif(@$_function AND $_class == $class AND $_function == $function AND $id == null)
			return 'active';
		elseif($_class == $class AND $function == null)
			return 'active';
		else
			return '';
	}
}

/*
| array search
*/
if ( ! function_exists('get_array'))
{
	function get_array($array, $key, $value, $limit = NULL, $offset = 0)
	{
	    $results = array();

	    if (is_array($array)) {
	        if (isset($array[$key]) && $array[$key] == $value) {
	            $results[] = $array;
	        }

	        foreach ($array as $subarray) {
	            $results = array_merge($results, get_array($subarray, $key, $value));
	        }
	    }

	    if($limit != NULL){
	    	$_results = array_slice($results, $offset, $limit);
	    }
	    else{
	    	$_results = $results;
	    }

	    return $_results;
	}
}

/*
| create dir
*/
if( ! function_exists('create_dir'))
{
	function create_dir(){
		$ci = get_instance();
		define ('FTP_USER', $ci->config->item('ftp_username'));
		define ('FTP_PASS', $ci->config->item('ftp_password'));

		$year = './'.UPLOAD_PATH.date('Y');
		if(!file_exists($year)){
			mkdir('./'.UPLOAD_PATH.date('Y').'/', 0777, TRUE);
			chmod('./'.UPLOAD_PATH.date('Y').'/', 0777);
			$month = './'.UPLOAD_PATH.date('Y').'/'.date('m');
			if(!file_exists($month)){
				mkdir('./'.UPLOAD_PATH.date('Y').'/'.date('m').'/', 0777, TRUE);
				chmod('./'.UPLOAD_PATH.date('Y').'/'.date('m').'/', 0777);
			}
		}
		else{
			$month = './'.UPLOAD_PATH.date('Y').'/'.date('m');
			if(!file_exists($month)){
				mkdir('./'.UPLOAD_PATH.date('Y').'/'.date('m').'/', 0777, TRUE);
				chmod('./'.UPLOAD_PATH.date('Y').'/'.date('m').'/', 0777);
			}
		}
	}
}

/*
| file color
*/
if ( ! function_exists('file_color'))
{
	function file_color($file_type)
	{
		if(strrpos($file_type, 'excel') !== FALSE)
			$_color = 'green';
		elseif(strrpos($file_type, 'word') !== FALSE)
			$_color = 'blue';
		elseif(strrpos($file_type, 'pdf') !== FALSE)
			$_color = 'orange';
		else
			$_color = 'grey';

		return $_color;
	}
}

/*
| get weeks
*/
if ( ! function_exists('get_weeks'))
{
	function get_weeks($start_date, $end_date){
		$signupweek = date("W",strtotime($start_date));
		$year = date("Y",strtotime($start_date));
		$currentweek = date("W",strtotime($end_date));

		for($i = $signupweek; $i <= $currentweek; $i++) {
		    $result = get_week($i,$year);
			$weeks[$i] = array(
				'monday' =>$result['start'],
				'sunday' => $result['end']
				);
		}

		return $weeks;
	}
}

if ( ! function_exists('get_week'))
{
	function get_week($week, $year) {
		$dto = new DateTime();
		$result['start'] = $dto->setISODate($year, $week, 1)->format('d-m-Y');
		$result['end'] = $dto->setISODate($year, $week, 7)->format('d-m-Y');
		return $result;
	}
}

/*
| highlight
*/
if ( ! function_exists('highlight'))
{
	function highlight($text, $words) {
	    $highlighted = preg_filter('/' . preg_quote($words) . '/i', '<b><span class="search-highlight">$0</span></b>', $text);
	    if (!empty($highlighted)) {
	        $text = $highlighted;
	    }
	    return $text;
	}
}

/*
| html
*/
if ( ! function_exists('html'))
{
	// html
	function html($slug){
		$a = explode(".",$slug);
		return $a[0];
	}
}

/*
| is_ajax check
*/
if ( ! function_exists('is_ajax'))
{
	function is_ajax()
	{
		$_ci =&get_instance();
		return ($_ci->input->server('HTTP_X_REQUESTED_WITH') && ($_ci->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest'));
	}
}

/*
| open menu
*/
if ( ! function_exists('open_menu'))
{
	// html
	function open_menu($class){
		$ci = get_instance();
		$_class = $ci->uri->segment(1);
		if($_class == $class)
			return 'open';
		else
			return '';
	}
}

/*
| tree menu
*/
function getMenu($list, $arr, $attr, $child_attr = '')
{
    $menu = buildTree($arr);
    $result = makeMenu($list, $menu, $attr, $child_attr);

    return $result;
}

function buildTree(array $elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent'] == $parentId) {
            $children = buildTree($elements, $element['description']);
            if ($children) {
                $element['child'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

function makeMenu($list = 'ul', $array, $attr = '', $children_attr = '')
{
	if (empty($array))
		return '';

	//Recursive Step: make a list with children lists
	$output = '<'.$list.' '.$attr.'>';
	$no = 1;
	foreach ($array as $key => $item) {
		if(isset($item['children'])):
			$children = makeMenu($list, $item['children'], $children_attr);
		else:
			$children = '';
		endif;

		if($list == 'ul'):
			$href = ($item['name'] == 'http://') ? BASE_URL : $item['name'];
			$output .= '<li><a href="'.$href.'">'.$item['name'].'</a>'.$children.'</li>';
		endif;
		$no++;
	}
	$output .= '</'.$list.'>';

	return $output;
}



/*
| btndrop
*/
if ( ! function_exists('btndrop'))
{
    function btndrop($btn)
    {
        $output = '<div class="btn-group">
            <button type="button" class="btn btn-default"><i class="fa fa-gear"></i></button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu absolute-right" role="menu">';
            foreach ($btn as $value) {
                $url = (@$value['url']) ?: '#';
                $ajax = (@$value['url']) ? 'ajax' : '';
                $msg =  (@$value['msg']) ? 'data-msg="'.$value['msg'].'"' : '';
                $output.= '<li><a href="'.$url.'" title="'.$value['text'].'" '.@$value['act'].' '.$msg.' class="'.$ajax.'">'.$value['text'].'</a></li>';
            }
        $output.= '</ul></div>';

        return $output;
    }
}

if ( ! function_exists('oldata'))
{
    function oldata($data)
    {
        $temp = explode("<br>", $data);
        $output = '<ol>';
        foreach ($temp as $value) {
            $output.= '<li>'.$value.'</li>';
        }
        $output.= '</ol>';

        return $output;
    }
}

/*
| reset number
*/
if ( ! function_exists('reset_number'))
{
	function reset_number($number)
	{
		$new_number = str_replace(",", "", $number);
		return $new_number;
	}
}

/*
| number format
*/
if ( ! function_exists('ribuan'))
{
	function ribuan($number, $dec = 2){
		$uang = number_format($number, $dec, '.', ',');

		return $uang;
	}
}

if ( ! function_exists('ribuan_clean'))
{
	function ribuan_clean($str){
            $str = str_replace(',','',$str);

            return $str;
	}
}

/*
| tohari - hari indonesia
*/
if ( ! function_exists('tohari'))
{
	function tohari($d){
		$id = array('1'=>'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');

		$hari = $id[$d];

		return $hari;
	}
}

/*
| toindo - bulan indonesia
*/
if ( ! function_exists('toindo'))
{
	function toindo($date){
		$x = explode("-", $date);
		$id = array(
			'01'=>'Januari', 
			'02'=>'Februari', 
			'03'=>'Maret', 
			'04'=>'April', 
			'05'=>'Mei', 
			'06'=>'Juni', 
			'07'=>'Juli', 
			'08'=>'Agustus', 
			'09'=>'September', 
			'10'=>'Oktober', 
			'11'=>'November', 
			'12'=>'Desember', 
			);

		return @$x[2].' '.@$id[$x[1]].' '.@$x[0];
	}
}

/*
| toroman - bulan indonesia
*/
if ( ! function_exists('toroman'))
{
	function toroman($num){
	    $n 		= intval($num); 
	    $res 	= ''; 

	    //array of roman numbers
	    $romanNumber_Array = array( 
	        'M'  => 1000, 
	        'CM' => 900, 
	        'D'  => 500, 
	        'CD' => 400, 
	        'C'  => 100, 
	        'XC' => 90, 
	        'L'  => 50, 
	        'XL' => 40, 
	        'X'  => 10, 
	        'IX' => 9, 
	        'V'  => 5, 
	        'IV' => 4, 
	        'I'  => 1); 

	    foreach ($romanNumber_Array as $roman => $number){ 
	        //divide to get  matches
	        $matches = intval($n / $number); 

	        //assign the roman char * $matches
	        $res .= str_repeat($roman, $matches); 

	        //substract from the number
	        $n = $n % $number; 
	    } 

	    // return the result
	    return $res; 
	}
}

/*
| time elapsed
*/
if ( ! function_exists('time_elapsed_string'))
{
	function time_elapsed_string($datetime, $lang = 'en', $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    if($lang == 'id'):
		    $string = array(
		        'y' => 'tahun',
		        'm' => 'bulan',
		        'w' => 'minggu',
		        'd' => 'hari',
		        'h' => 'jam',
		        'i' => 'menit',
		        's' => 'detik',
		    );
		else:
		    $string = array(
		        'y' => 'year',
		        'm' => 'month',
		        'w' => 'week',
		        'd' => 'day',
		        'h' => 'hour',
		        'i' => 'minute',
		        's' => 'second',
		    );
		endif;

	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	        	if($lang == 'id')
		            $v = $diff->$k.' '.$v;
		        else
		            $v = $diff->$k.' '.$v.($diff->$k > 1 ? 's' : '');
	        }
	        else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);

	    if($lang == 'id')
	    	return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
	    else
	    	return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

/*
| array print
*/
if ( ! function_exists('array_print'))
{
	function array_print($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
		exit();
	}
}

/*
| ahref
*/
if ( ! function_exists('ahref'))
{
    function ahref($url, $text) {
        $ahref = '<a href="'.$url.'" class="ajax">'.$text.'</a>';

        return $ahref;
    }
}

if (! function_exists('tes_data'))
{
	function tes_data($data=array())
		{
			echo "<pre>";
			print_r($data);
			exit();
		}

}
function list_modules()
{
	$path = FCPATH. 'rn-app/modules/';
	$directories = glob( $path.'*' , GLOB_ONLYDIR);
	foreach ($directories as $k => $directory) {
		$directories[$k] = str_replace($path, '', $directory);
	}
	$news = array_values(array_diff($directories, array('auth','rn_role','rn','rn_groups','rn_users','api','rn_404')));
	foreach ($news as $k => $new) {
		$news[$k] = str_replace('rn_','', $new);
	}
	return $news;
}


if (! function_exists('blade_back')) {

	/**
	 * Get blade view
	 *
	 * @param $view
	 * @param array $data
	 * @param boolean $return
	 * @return mixed
	 */
	function blade_back($view, $data = array(), $return=false)
	{
		$blade = new \Jenssegers\Blade\Blade( array(FCPATH.'rn-app/modules/'), FCPATH.'rn-app/cache');
		if( $return==false ){
			echo $blade->render($view, $data);
			exit();
		}else{
			return $blade->render($view, $data);
		}
	}
}


if(!function_exists('my_json')){
	function my_json($data=array()){
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
	}
}

if (! function_exists('json_response')) {

	/**
	 * Create json response
	 *
	 * @param $data
	 * @param $code int
	 * @return string
	 */
	function json_response($data, $code = 200) {
		set_status_header($code);
		header("Content-Type: application/json");
		echo json_encode($data);
		exit();
	}
}

if (! function_exists('json_toarray')) {

	/**
	 * Convert Json object (StdClass) to array
	 *
	 * @param $data
	 * @return mixed
	 */
	function object_to_array($data) {
		return json_decode(json_encode($data), true);
	}

	if(!function_exists('format_title')){
		/**
		 * Convert to uppercase first string and remove some Underscores with space
		 * @param $title
		 * @return string
		 */
		function format_title($title){
			return ucwords( (str_replace('_',' ', $title)));
		}
	}
}


if ( ! function_exists('tgl_indo'))
{
	function date_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

//Format Shortdate
if ( ! function_exists('shortdate_indo'))
{
	function shortdate_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = short_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.'/'.$bulan.'/'.$tahun;
	}
}

if ( ! function_exists('shortdate_luar'))
{
	function shortdate_luar($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = short_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $bulan.'/'.$tanggal.'/'.$tahun;
	}
}

if (! function_exists('changedate')){
	function changedate($param){


		return date('Y-m-d', strtotime($param));
	}
}
if ( ! function_exists('short_bulan'))
{
	function short_bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "01";
				break;
			case 2:
				return "02";
				break;
			case 3:
				return "03";
				break;
			case 4:
				return "04";
				break;
			case 5:
				return "05";
				break;
			case 6:
				return "06";
				break;
			case 7:
				return "07";
				break;
			case 8:
				return "08";
				break;
			case 9:
				return "09";
				break;
			case 10:
				return "10";
				break;
			case 11:
				return "11";
				break;
			case 12:
				return "12";
				break;
		}
	}
}
//Format Medium date
if ( ! function_exists('mediumdate_indo'))
{
	function mediumdate_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = medium_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.'-'.$bulan.'-'.$tahun;
	}
}
if ( ! function_exists('medium_bulan'))
{
	function medium_bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Ags";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	}
}
//Long date indo Format
if ( ! function_exists('longdate_indo'))
{
	function longdate_indo($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];
		$bulan = bulan($pecah[1]);

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari.', '.$tgl.' '.$bulan.' '.$thn;
	}
}
if ( ! function_exists('convert_to_number')) {
	function convert_to_number($rupiah)
	{
		return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
	}
}
if ( ! function_exists('convert_to_rupiah')) {
	function convert_to_rupiah($angka)
	{
		return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
	}
}

if ( ! function_exists('notfound')) {
	function notfound()
	{
		redirect('rn/404','refresh');
	}
}

if ( ! function_exists('token_chat')) {
	function token_chat()
	{
		$seed = floor(time()/(60)*2);
		srand($seed);
		$item = md5(rand(0,99999));
		return $item;
	}
}

