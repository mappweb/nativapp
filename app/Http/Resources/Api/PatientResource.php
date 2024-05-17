<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id()->value(),
            'document' => $this->document()->value(),
            'firstName' => $this->name()->firstName()->value(),
            'lastName' => $this->name()->lastName()->value(),
            'birthday' => $this->birthday()->value(),
            'email' => $this->contact()->email()->value(),
            'phone' => $this->contact()->phone()->value(),
            'genre' => $this->genre()->value(),
        ];
    }
}
