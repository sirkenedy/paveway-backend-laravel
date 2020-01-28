<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Faculty\FacultyStoreRequest;
use App\Http\Requests\Faculty\FacultyUpdateRequest;
use App\Http\Resources\Faculty\Faculty as FacultyResource;
use App\Http\Resources\Faculty\FacultyCollection;
use App\Repositories\Eloquent\Faculty\FacultyRepositoryInterface;
use App\Faculty;

class FacultyController extends Controller
{

    protected $faculty;

    public function __construct(FacultyRepositoryInterface $faculty)
    {
        // $this->middleware('isAdmin')->only(['store','update','destroy']);
        $this->faculty = $faculty;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FacultyCollection($this->faculty->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyStoreRequest $request)
    {
        $data = $this->formatInputKey($request);
        
        $result = $this->faculty->store($data);

        if(!$result) {
            return response()->json(['error' => "An error occured. Please try again"]);
        }

        return response()->json(['success' => "Faculty created successfully"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = $this->faculty->get($id);
        return new FacultyResource($faculty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyUpdateRequest $request, $id)
    {
        
        $data = $this->formatInputKey($request);
        if (!$this->faculty->update($id, $data))
        {
            return response()->json(['error' => "An error occured. Please try again"]);
        }
        return response()->json(['success' => "faculty details updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($data = $this->faculty->delete($id))
        {
            return response()->json(['success' => "deleted successfully"], 200);
        }
    }

    public function departments($id)
    {
        $departments = $this->faculty->getDepartments($id);
        return response()->json(['departments' => $departments], 201);
    }

    protected function formatInputKey($request)
    {
        // $request->request->add(['fac_title' => $request->title, 'fac_key' => $request->key]);
        // return $request->only(['fac_title', 'fac_key', 'title']);
        return [
            'fac_title' => $request->title,
            'fac_key' => $request->key
        ];
     }
}
