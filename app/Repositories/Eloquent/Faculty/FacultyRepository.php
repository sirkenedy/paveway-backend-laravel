<?php

namespace App\Repositories\Eloquent\Faculty; 

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Faculty;

class FacultyRepository implements FacultyRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Faculty::findOrFail($id);
    }

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all()
    {
        return Faculty::all();
    }

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($id)
    {
        // $book_data = $this->uploadBookFile($request, 'material')
        $faculty = Faculty::findOrFail($id);
        $process = Faculty::destroy($faculty->id);
        if($process)
        {
            return true;
        }
        return false;
    }

    /**
     * Updates a book.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        $faculty = Faculty::find($id);
        if(!$faculty)
        {
            throw new ModelNotFoundException('Faculty to be updated does not exist');
            return false;
        }
        $faculty->update($data);
        return true;
    }

    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $data)
    {
        $process = Faculty::create($data);
        if($process) {
            return $process;
        }

        return false;
    }

    public function getDepartments($id)
    {
        $faculty = Faculty::find($id);
        if (!$faculty) {
            throw new ModelNotFoundException('Faculty does not exist');
        }
        return $faculty->departments;
    }
}