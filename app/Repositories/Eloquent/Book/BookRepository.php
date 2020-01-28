<?php

namespace App\Repositories\Eloquent\Book;
// use App\Repositories\BookRepositoryInterface;
use App\Book;

class BookRepository implements BookRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($book_id)
    {
        return Book::findOrFail($book_id);
    }

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all()
    {
        return Book::all();
    }

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($book_id)
    {
        // $book_data = $this->uploadBookFile($request, 'material')
        $getbook = Book::findOrFail($book_id);
        Book::destroy($getbook->id);
        return $getbook->publicId;
    }

    /**
     * Updates a book.
     *
     * @param int
     * @param array
     */
    public function update($book_id, array $book_data)
    {
        $getbook = Book::find($book_id);
        return $getbook->update($book_data);
    }

    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $book_data)
    {
        return Book::create($book_data);
    }
}