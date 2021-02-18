<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_taxonomy_tree_upd {

    public $version = '1.0.0';

    public function install()
    {
        $data = array(
            'module_name'           => 'Category_taxonomy_tree',
            'module_version'        => $this->version,
            'has_cp_backend'        => 'y',
            'has_publish_fields'    => 'y'
        );

        ee()->db->insert('modules', $data);

        $this->createSettings();

        return true;
    }

    private function createSettings()
    {
        ee()->load->dbforge();

        if(!ee()->db->table_exists('category_taxonomy_tree_settings'))
        {
            ee()->dbforge->add_field(
                [
                    'id'           => [
                        'type'              => 'int',
                        'constraint'        => 6,
                        'unsigned'          => true,
                        'auto_increment'    => true,
                    ],
                    'categories'      => [
                        'type'              => 'text',
                    ],
                ]
            );

            ee()->dbforge->add_key('id', true);
            ee()->dbforge->create_table('category_taxonomy_tree_settings');
        }
    }

    public function update($current = '')
    {
        return true;
    }

    public function uninstall()
    {
        ee()->db->where('module_name', 'Category_taxonomy_tree');
        ee()->db->delete('modules');

        ee()->load->dbforge();
        $tablePrefix = ee()->db->dbprefix;
        ee()->db->query("DROP TABLE IF EXISTS {$tablePrefix}category_taxonomy_tree_settings");
        return true;
    }
}