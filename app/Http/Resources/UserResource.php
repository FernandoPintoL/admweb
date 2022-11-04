<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return parent::toArray([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'nick' => $this->nick,
            'status' => $this->status,
            'profile_photo_path' => $this->profile_photo_path,
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString(),
        ]);
    }
}