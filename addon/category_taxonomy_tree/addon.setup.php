<?php

return [
    'author'            => 'Doug Black',
    'author_url'        => 'https://triplenerdscore.net/',
    'name'              => 'Category Taxonomy Tree',
    'description'       => 'Sort categories and output them in the exact order',
    'version'           => '1.0.0',
    'namespace'         => 'CategoryTaxonomyTree',
    'settings_exist'    => true,
    // Advanced settings
    'models'            => [
        'CategoryTaxonomyTreeSettings'    => 'Models\CategoryTaxonomyTreeSettings',
	],
];