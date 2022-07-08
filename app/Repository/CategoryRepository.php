<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Category;

class CategoryRepository extends RepositoryAbstract
{
    public function getAll()
    {
        return Category::all();
    }
    public function getById($categoryId)
    {
        return Category::findOrFail($categoryId);
    }
    public function delete($categoryId)
    {
        Category::destroy($categoryId);
    }
    public function create(array $categoryDetails)
    {
        return Category::create($categoryDetails);
    }
    public function update($categoryId, array $newDetails)
    {
        return Category::whereId($categoryId)->update($newDetails);
    }
}
