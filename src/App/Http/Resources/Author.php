<?php

namespace Yahyya\bookstore\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Author extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'firstName'=>$this->first_name,
            'lastName'=>$this->last_name,
            'bookStock'=>$this->books()->sum('stock')
        ];
    }
}
