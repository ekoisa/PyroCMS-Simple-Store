<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Products Module
 *
 * @author 		Patrick Kivits - Woodits Webbureau
 * @website		http://woodits.nl
 * @package 	PyroCMS
 * @subpackage 	Products Module
 */
class Specials extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('specials_m');
		$this->lang->load('general');
		$this->lang->load('specials');
	}

	public function index($offset = 0)
	{
		$limit = 5;
		
		$data->items = $this->specials_m->limit($limit)
			->offset($offset)
			->get_current();
			
		if (count($data->items))
		{
			$data->items_exist = TRUE;
		}
		else
		{
			$data->items_exist = FALSE;
		}

		// Params: (module/method, total count, limit, uri segment)
		$data->pagination = create_pagination('products/specials/index', $this->specials_m->count_all(), $limit, 3);

		$this->template->title($this->module_details['name'], lang('specials:label'))
			->build('specials', $data);
	}
	
	public function special()
	{	
		$data->specials = $this->specials_m->get($this->uri->segment(4));	
		$data->items = $this->specials_m->get_special_products($this->uri->segment(4));
			
		if (count($data->items))
		{
			$data->items_exist = TRUE;
		}
		else
		{
			$data->items_exist = FALSE;
		}

		$this->template->title($this->module_details['name'], lang('specials:label'))
			->build('special', $data);
	}
	
	public function archive($offset = 0)
	{
		$limit = 5;
		
		$data->items = $this->specials_m->limit($limit)
			->offset($offset)
			->get_all();
			
		if (count($data->items))
		{
			$data->items_exist = TRUE;
		}
		else
		{
			$data->items_exist = FALSE;
		}

		// Params: (module/method, total count, limit, uri segment)
		$data->pagination = create_pagination('products/specials/archive', $this->specials_m->count_all(), $limit, 3);

		$this->template->title($this->module_details['name'], lang('specials:label'))
			->build('specials', $data);
	}
}