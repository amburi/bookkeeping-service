<?php
/**
 * Created for transactions.
 * User: Amburi Roy
 * Email: amburi.roy@gmail.com
 */

namespace App\Http\Controllers;


use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Transaction Management API",
 *         description="A bookkeeping service that offers functionality for recording a list of transactions and retrieving valuable information from the recorded data.",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(
 *             email="amburi.roy@gmail.com"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         description="Transactions OpenApi Host",
 *         url=L5_SWAGGER_CONST_HOST
 *     ),
 *     @OA\Tag(name="transaction", description="Manage Transaction APIs"),
 *     @OA\Tag(name="asset", description="Manage Asset API"),
 * )
 */
class ApiBaseController extends Controller
{
    /**
     * Standard response with data
     * @param array|Collection $data
     * @return JsonResponse
     */
    public function response($data)
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }
        return response()->json(['data' => $data]);
    }
}
