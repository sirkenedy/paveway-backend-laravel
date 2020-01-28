<?php

namespace App\Repositories\Eloquent\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        $department = Department::find($id);
        if (!$department) {
            throw new ModelNotFoundException("Department doesn't not exist with ID " . $id);
        }
        return $department;
    }

    /**
     * Get's all books.
     *
     * @return mixed
     */
    public function all()
    {
        return Department::all();
    }

    /**
     * Deletes a book.
     *
     * @param int
     */
    public function delete($id)
    {
        // $book_data = $this->uploadBookFile($request, 'material')
        $faculty = Department::findOrFail($id);
        $process = Department::destroy($faculty->id);
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
        $faculty = Department::find($id);
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
        $process = Department::create($data);
        if($process) {
            return $process;
        }

        return false;
    }

//     public function getPrograms($id)
//     {
//         $faculty = Department::findOrFail($id);
        
//         $programs = Department::find($id)->programs;
//         return $programs;
//     }
}