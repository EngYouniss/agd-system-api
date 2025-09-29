<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractTypeResource;
use App\Models\ContractType;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    public function index(){

        $contractTypes=ContractType::get();
        if(count( $contractTypes)>0){
            return ApiResponse::reponseFn(200,' types retrived successfully',ContractTypeResource::collection($contractTypes));
        }
            return ApiResponse::reponseFn(200,' There is no types',[]);
    }
}
