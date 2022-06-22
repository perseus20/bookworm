<?php

namespace App\Repository;

use App\Interfaces\RepositoryInterface;

abstract class RepositoryAbstract implements RepositoryInterface
{
    public abstract function getAll();
    public abstract function getById($id);
    public abstract function delete($id);
    public abstract function create(array $details);
    public abstract function update($id, array $newDetails);
}
