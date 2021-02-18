<?php

namespace CategoryTaxonomyTree\Models;

use EllisLab\ExpressionEngine\Service\Model\Model;

class CategoryTaxonomyTreeSettings extends Model {

    // Documentation: https://docs.expressionengine.com/latest/development/services/model/building-your-own.html
    // You can get this model by using:
    // ee('Model')->get('{slug}:{class}');

    protected static $_primary_key = 'id';
    protected static $_table_name = 'category_taxonomy_tree_settings';

    // Add your properties as protected variables here
    protected $id;
    protected $categories;

}