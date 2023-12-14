<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\AssetRequest;
use App\Response\ApiResponse;
use App\Services\AssetService;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Exception\ValidationHttpException;
use Exception;
use Illuminate\Http\JsonResponse;

class AssetController
{
    /**
     * @var AssetService
     */
    private $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * Update asset price
     *
     * @param AssetRequest $request
     * @return JsonResponse
     *
     * @throws Exception
     * @OA\Post(
     *   path="/api/asset/update",
     *   summary="Update Asset Price",
     *   tags={"asset"},
     *   operationId="updateAsset",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="asset_id",
     *                     type="required|exists:assets,id",
     *                     example="1",
     *                 ),
     *                 @OA\Property(
     *                     property="latest_price",
     *                     type="numeric",
     *                 ),
     *             )
     *         ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success message",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *     ),
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Validation error",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="errors", type="object")
     *     ),
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="Error",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="errors", type="object")
     *     ),
     *   ),
     * )
     */
    public function updateAsset(AssetRequest $request)
    {
        try {
            $this->assetService->updateAsset($request->all());
            return ApiResponse::response(HttpStatus::HTTP_OK, HttpStatus::MESSAGES['ASSET_SUCCESSFUL']);
        } catch (ValidationHttpException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_VALIDATION, $e->getMessage(), $e->getErrors());
        } catch (ResourceException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_REQUEST, $e->getMessage(), $e->getErrors());
        } catch (Exception $e) {
            return ApiResponse::response($e->getCode(), $e->getMessage(), $e->getErrors());
        }
    }


}
