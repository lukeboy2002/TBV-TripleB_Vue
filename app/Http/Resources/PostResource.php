<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user', fn () => UserResource::make($this->user)),
            'category' => $this->whenLoaded('category', fn () => CategoryResource::make($this->category)),
            'title' => $this->title,
            'body' => $this->body,
            'html' => $this->html,
            'image' => $this->image,
            'published_at' => $this->published_at,
            'featured' => $this->featured,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'routes' => [
                'show' => $this->showRoute(),
            ],
        ];
    }
}
