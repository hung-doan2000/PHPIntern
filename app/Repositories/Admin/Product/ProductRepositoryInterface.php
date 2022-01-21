<?php


namespace App\Repositories\Admin\Product;


use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();
}
