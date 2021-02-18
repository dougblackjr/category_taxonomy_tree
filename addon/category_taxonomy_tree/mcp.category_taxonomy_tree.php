<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__ . '/services/SettingsService.php';

class Category_taxonomy_tree_mcp {

    public function index()
    {
        return SettingsService::form();
    }

    public function save()
    {
        return SettingsService::save();
    }

}