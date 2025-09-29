<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'contract number'=>$this->contract_number,
            'husband conditions'=>$this->husband_conditions,
            'wife conditions'=>$this->wife_conditions,
            'mahr'=>$this->mahr_total,
            'mahr paid'=>$this->mahr_paid,
            'mahr remaining'=>$this->mahr_remaining,
            'created at'=>$this->created_at,
            'updated at'=>$this->updated_at,
            'contract status'=>new ContractStatusResource($this->status),
            'contract type'=>new ContractTypeResource($this->contractType),

        ];
    }
}
