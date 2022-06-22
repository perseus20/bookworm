<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Author;

class AuthorRepository extends RepositoryAbstract
{
    public function getAll()
    {
        return Author::all();
    }
    public function getById($authorId)
    {
        return Author::findOrFail($authorId);
    }
    public function delete($authorId)
    {
        Author::destroy($authorId);
    }
    public function create(array $authorDetails)
    {
        return Author::create($authorDetails);
    }
    public function update($authorId, array $newDetails)
    {
        return Author::whereId($authorId)->update($newDetails);
    }
}
