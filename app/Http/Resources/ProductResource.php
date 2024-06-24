<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'ma_san_pham' => $this->id,
            'ten_san_pham' => $this->name,
            'gia' => $this->price,
            'anh' => $this->image ? url($this->image) : null,
            'ngay_tao' => $this->created_at->format('d/m/Y'),
            'ngay_cap_nhat' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
