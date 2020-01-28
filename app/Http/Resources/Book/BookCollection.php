<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     'data' => BookCollection::collection($this->collection),
        // ];
    }

    // public function with($request)
    // {
    //     $program  = $this->collection->map(
    //         function ($book) {
    //             return $book->program;
    //         }
    //     );
    // }
}
