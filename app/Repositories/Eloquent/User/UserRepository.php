<?php

namespace App\Repositories\Eloquent\User;
// use App\Repositories\BookRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($book_id)
    {
        return User::findOrFail($book_id);
    }

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($book_id)
    {
        // $book_data = $this->uploadBookFile($request, 'material')
        $getbook = User::findOrFail($book_id);
        User::destroy($getbook->id);
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
        $getbook = User::find($book_id);
        return $getbook->update($book_data);
    }

    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $book_data)
    {
        return User::create($book_data);
    }

    public function userDetails($id)
    {
        $user = User::find($id);
        return $user;
    }
}