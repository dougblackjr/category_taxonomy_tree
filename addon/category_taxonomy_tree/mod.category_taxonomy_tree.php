<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__ . '/services/SettingsService.php';

class Category_taxonomy_tree {

    public function display()
    {
    	$asJson = ee()->TMPL->fetch_param('json');

    	$cats = SettingsService::getSettings();

    	if($asJson) {
    		return json_encode($cats);
    	} else {
    		$tagdata = ee()->TMPL->tagdata;
    		return ee()->TMPL->parse_variables($tagdata, [$cats]);
    	}
    }

}