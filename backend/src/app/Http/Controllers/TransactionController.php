<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Response\ApiResponse;
use App\Services\TransactionService;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Exception\ValidationHttpException;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Enums\TransactionType;

/**
 * Class TransactionController
 * @author Amburi Roy <amburi.roy@gmail.com>
 * @package App\Http\Controllers
 */
class TransactionController extends ApiBaseController
{

    /**
     * @var TransactionService
     */
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Create transaction
     *
     * @param TransactionRequest $request
     * @return TransactionResource|JsonResponse
     *
     * @throws Exception
     * @OA\Post(
     *   path="/api/transaction/create",
     *   summary="Recording New Transaction",
     *   tags={"transaction"},
     *   operationId="createTransaction",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="party_id",
     *                     type="required|exists:users,id",
     *                     example= "1",
     *                 ),
     *              @OA\Property(
     *                     property="counterparty_id",
     *                     type="required|exists:users,id",
     *                     example= "2",
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="required|string|max:255",
     *                     enum={"DEPOSIT", "WITHDRAW", "BUY", "SELL"},
     *                     example=TransactionType::DEPOSIT
     *                 ),
     *                  @OA\Property(
     *                     property="asset_id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="quantity",
     *                     type="integer",
     *                 ),
     *                  @OA\Property(
     *                     property="total_amount",
     *                     type="numeric",
     *                 ),
     *                 @OA\Property(
     *                     property="comment",
     *                     type="nullable|string|max:1000"
     *                 ),
     *             )
     *         ),
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Transaction created",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/Transaction")
     *     )
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Validation error",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="errors", type="object")
     *     )
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="Internal server error",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="errors", type="object")
     *     )
     *   )
     * )
     */
    public function createTransaction(TransactionRequest $request)
    {
        try {
            $this->transactionService->createTransaction($request->all());
            return ApiResponse::response(HttpStatus::HTTP_CREATED, HttpStatus::MESSAGES['TRANSACTION_SUCCESSFUL']);
        } catch (ValidationHttpException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_VALIDATION, $e->getMessage(), $e->getErrors());
        } catch (ResourceException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_REQUEST, $e->getMessage(), $e->getErrors());
        } catch (Exception $e) {
            return ApiResponse::response($e->getCode(), $e->getMessage(), $e->getErrors());
        }
    }

    /**
     * Get user's position on a given date
     *
     * @param int $userId
     * @param string $date
     * @return false|string
     *
     * @OA\Get(
     *   path="/api/transaction/position/{userId}/{date}",
     *   summary="Daily Position",
     *   tags={"transaction"},
     *   operationId="dailyPosition",
     *
     *    @OA\Parameter(
     *      name="userId",
     *      description="User ID",
     *      example=1,
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="date",
     *      description="Date in YYYY-MM-DD format",
     *      example="2023-07-01",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *          type="string",
     *          pattern="^\d{4}-\d{2}-\d{2}$",
     *          format="date"
     *      )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="User's daily position by date",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/Transaction")
     *     )
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="Internal server error",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="errors", type="object")
     *     )
     *   )
     * )
     */
    public function getBalancePosition(int $userId, string $date)
    {
        try {
            $positionResources = $this->transactionService->getBalancePosition($userId, $date);
            return $this->response($positionResources);
        } catch (ValidationHttpException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_VALIDATION, $e->getMessage(), $e->getErrors());
        } catch (ResourceException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_REQUEST, $e->getMessage(), $e->getErrors());
        } catch (Exception $e) {
            return ApiResponse::response($e->getCode(), $e->getMessage(), $e->getErrors());
        }
    }

}
