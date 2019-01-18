<?php

namespace app\models\repositories;


use app\models\entities\Product;

class ProductRepository extends Repository
{
    /**
     * Returns 'products' - the name of a products table.
     * @return string
     */
    public function getTableName(): string
    {
        return 'products';
    }

    /**
     * Returns the Product class name.
     * @return string
     */
    public function getEntityClass(): string
    {
        return Product::class;
    }
}