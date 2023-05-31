<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'name' => $this->name,
            'product' => $this->product,
            'address' => $this->address,
            'number' => $this->number,
            'employee_id' => $this->employee_id,
            'employee' => $this->employee,
            'created_at' => $this->created_at,
        ];
    }
}
