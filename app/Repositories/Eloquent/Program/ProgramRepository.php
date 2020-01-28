<?php

namespace App\Repositories\Eloquent\Program;
use App\Program;

class ProgramRepository implements ProgramRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Program::findOrFail($id);
    }

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all()
    {
        return Program::all();
    }

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($id)
    {
        // $book_data = $this->uploadBookFile($request, 'material')
        $faculty = Program::findOrFail($id);
        $process = Program::destroy($faculty->id);
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
        $faculty = Program::find($id);
        if($faculty->update($data))
        {
            return true;
        }
        return false;
    }

    /**
     * create a book.
     *
     * @param array
     */
    public function store(array $data)
    {
        $process = Program::create($data);
        if($process) {
            return true;
        }

        return false;
    }

    public function getPrograms($id)
    {
        $faculty = Program::findOrFail($id);
        
        $programs = Program::find($id)->programs;
        return $programs;
    }
}