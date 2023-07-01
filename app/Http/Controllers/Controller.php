<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Generate success Response
     * @param  array $data [description]
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generateSuccess($data = [], $mergeArray = true)
    {
        $arr = [
            'status' => __('messages.success'),
            'description' => __('messages.ok')
        ];

        if ($mergeArray) {
            return response()->json(array_merge($arr, ['data' => $data]), Response::HTTP_OK);
        }

        return response()->json($arr, Response::HTTP_OK);
    }

    /**
     * Generate success created Response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generateSuccessCreated($data = [], $mergeArray = true)
    {
        $arr = [
            'status' => __('messages.success'),
            'description' => __('messages.created')
        ];

        if ($mergeArray) {
            return response()->json(array_merge($arr, ['data' => $data]), Response::HTTP_CREATED);
        }

        return response()->json($arr, Response::HTTP_CREATED);
    }
}
