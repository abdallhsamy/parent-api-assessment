<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\ParentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentApiController extends Controller
{
    public function index(Request $request, ParentService $parentService)
    {
        $parents = $parentService->getAllParents($request->all());

        return response()->json($parents);
    }
}
