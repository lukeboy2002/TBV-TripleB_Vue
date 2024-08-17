<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

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
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'title' => $this->title,
            'body' => $this->body,
            'html' => $this->html,
            'comments_count' => Number::abbreviate($this->comments_count),
            'likes_count' => Number::abbreviate($this->likes_count),
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
