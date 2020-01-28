<?php

namespace App\Repositories\Eloquent\User;

interface UserRepositoryInterface
{
    /**
     * Get's a book by it's ID
     *
     * @param int
     */
    public function get($book_id);

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
    public function delete($book_id);

    /**
     * Updates a book.
     *
     * @param int
     * @param array
     */
    public function update($book_id, array $book_data);

    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $book_data);

    public function userDetails($id);
}