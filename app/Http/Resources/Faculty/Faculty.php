<?php

namespace App\Http\Resources\Faculty;

use Illuminate\Http\Resources\Json\JsonResource;

class Faculty extends JsonResource
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
            'title' => $this->fac_title,
            'key' => $this->fac_key
        ];
    }
}
