<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'ma_nguoi_dung' => $this->id,
            'ten' => $this->name,
            'thu_dien_tu' => $this->email,
            'ngay_tao' => $this->created_at->format('d/m/Y'),
            'ngay_cap_nhat' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
