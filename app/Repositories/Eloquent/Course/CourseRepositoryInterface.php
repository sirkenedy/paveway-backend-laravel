<?php

namespace App\Repositories\Eloquent\Course;

interface CourseRepositoryInterface
{
    /**
     * Get's a book by it's ID
     *
     * @param int
     */
    public function get($id);

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
     * Updates a book.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);

    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $data);
}