<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use ParsedownExtra;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $Extra = new ParsedownExtra();
        $data = parent::toArray($request) + ['html' => $Extra->text($this->content)];
        return $data;
    }
}
