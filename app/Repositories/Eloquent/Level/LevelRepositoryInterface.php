<?php

namespace App\Repositories\Eloquent\Level;

interface LevelRepositoryInterface
{

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($id);


    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $data);
    
}