<?php

namespace App\Http\Resources;

use App\Models\Todo;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = Todo::class;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"          => $this->id,
            "title"       => $this->title,
            "description" => $this->description,
            "complete"    => $this->complete,
            "created_at"  => $this->created_at,
            "updated_at"  => $this->updated_at,
        ];
    }
}
