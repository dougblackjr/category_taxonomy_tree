<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SettingsService {

	public static function form()
	{
		// Setup fun
		ee()->load->library('javascript');
		ee()->cp->add_to_head("<link rel='stylesheet' href='". (defined('URL_THIRD_THEMES') ? URL_THIRD_THEMES : ee()->config->slash_item('theme_folder_url').'third_party/') ."category_taxonomy_tree/ctt.css'>");

		$categories = self::getSettings();

		// Never mind
		$params = [
			'categories'		=> $categories,
			'save_url'			=> ee('CP/URL', 'addons/settings/category_taxonomy_tree/save'),
		];

		return ee()->load->view('settings', $params, true);
	}

	public static function save()
	{
		$categories = ee()->input->get_post('categories');

		$data = ee('Model')->get('category_taxonomy_tree:CategoryTaxonomyTreeSettings')
							->first();
		if( ! $data ) {
			$data = ee('Model')->make('category_taxonomy_tree:CategoryTaxonomyTreeSettings');
		}

		$data->categories = $categories;
		$data->save();

		ee()->output->send_ajax_response($data);
	}

	public static function getSettings()
	{
		$data = ee('Model')->get('category_taxonomy_tree:CategoryTaxonomyTreeSettings')
							->first();

		if(!isset($data->categories)) {
			$categoryData = [];
		} else {
			$categoryData = explode('|', $data->categories);
		}

		$categories = static::getCategories();

		foreach ($categories as $catId => $cat) {
			if(!in_array($catId, $categoryData)) {
				$categoryData[] = $cat['id'];
			}
		}

		$results = [];
		foreach ($categoryData as $catId) {
			$results[] = [
				'id'	=> $catId,
				'name'	=> $categories[$catId],
			];
		}

		return $results;
	}

	public static function getCategories()
	{
		$categories =  ee('Model')
						->get('Category')
						// This should be a setting, but don't @ me
						->filter('group_id', 4)
						->filter('parent_id', 0)
						->all();

		$results = [];

		$categories->each(function($c) use (&$results) {
			$results[$c->cat_id] = $c->cat_name;
		});

		return $results;
	}
}