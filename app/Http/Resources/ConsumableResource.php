<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsumableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sub_category' => $this->product->sub_category->name,
            'product_name' => $this->product->brand->name . " " . $this->product->model,
            'invoice_details' => $this->invoice->invoice_number,
            'invoice_date' => $this->invoice->invoice_date,

            'balance' => $this->balance,
        ];
    }
}
