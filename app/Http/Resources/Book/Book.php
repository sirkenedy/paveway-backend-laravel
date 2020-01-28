<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProgramRelationshipResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,  
            'title' => $this->books_title,
            'author' => $this->books_author,
            'publisher' => $this->books_publisher,
            'url' => $this->books_material,
            'posted_by' => $this->posted_by,
            'related' => [
                'faculty' => [
                    'id' => $this->program->department->faculty->id,
                    'faculty_name' => $this->program->department->faculty->fac_title
                ],
                'department' => [
                    'id' => $this->program->department->id,
                    'department' => $this->program->department->dep_title
                ],
                'program' => [
                    'id' => $this->program->id,
                    'program' => $this->program->title
                ]
            ]  
          ];
    }
}
