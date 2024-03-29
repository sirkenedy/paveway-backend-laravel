<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'email' => $this->email,
            'unique_no' => $this->unique_no,
            'role' => $this->role->title,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,       
          ];
    }
}
