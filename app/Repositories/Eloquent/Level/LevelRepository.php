<?php

namespace App\Repositories\Eloquent\Level; 

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Level;

class LevelRepository implements LevelRepositoryInterface
{

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all()
    {
        return Level::all();
    }

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($id)
    {
        // $book_data = $this->uploadBookFile($request, 'material')
        $faculty = Level::findOrFail($id);
        $process = Level::destroy($faculty->id);
        if($process)
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
        $process = Level::create($data);
        if($process) {
            return $process;
        }

        return false;
    }
}