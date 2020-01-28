<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\Book\Book as BookResource;
use App\Http\Resources\Book\BookCollection;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\Book\BookRepositoryInterface;
use App\Book;
// use Cloudder;
use  App\Traits\StoreBookFileTrait;

class BookController extends Controller
{
    use StoreBookFileTrait;

    protected $book;

    public function __construct(BookRepositoryInterface $book)
    {
        $this->middleware('isAdmin')->only(['store','update','destroy']);
        $this->book = $book;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new BookResource(Book::first());
        return new BookCollection(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $fileResult = $this->uploadBookFile($request, 'material');
        $book_data = $request->all();
        $book_data['posted_by'] = auth('api')->user()->id;
        $book_data['material'] = $fileResult['secure_url'];
        $book_data['publicId'] = $fileResult['public_id'];

        if($this->book->store($book_data))
        {
            return response()->json(['Book' => $book_data], 201);
        }

        return response()->json(['error' => "An error occur while trying to upload file. please try again or contact system adminstrator"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->get($id);
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $updated_book = $request->all();
        if($book = $this->book->update($id, $updated_book)){
            return response()->json(['Book' => $updated_book], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBookFile(Request $request, $id)
    {
        if($book = $this->book->get($id)){
            $fileResult = $this->updateFile($request, 'material', $book->publicId);
            $book_data = $request->only('material');
            $book_data['material'] = $fileResult['secure_url']; 

            /// when going through the varibes  it cam just be data 
            
            return response()->json(['Book' => $book_data], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicId = $this->book->delete($id);
        // $book = Book::find($id);
        $fileResult = $this->removeFile($publicId);
        if($fileResult)
        {
            // $book->delete();
            return response()->json(['Book' => "book deleted succesfully"], 200);
        }

        return response()->json(['error' => "an error Occured"], 422);
    }
}
