<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'skill' => new SkillResource($this->whenLoaded('skill')),
            'name' => $this->name,
            'project_url' => $this->project_url,
            'image' => asset('/storage/' . $this->image),
        ];
    }
}
