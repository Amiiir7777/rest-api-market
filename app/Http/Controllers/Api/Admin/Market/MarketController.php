<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\Market\MarketResource;
use App\Http\Resources\Api\Admin\Market\ShowMarketResource;
use App\Models\Market\Market;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get (
     *      path="/admin/market/market",
     *      operationId="GetMarkets",
     *      tags={"Auth"},
     *      summary="get markets",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found Exception",
     *          @OA\JsonContent()
     *       ),
     *       security={{ "bearer_token": {} }}
     *     )
     */

    public function index()
    {
        $markets = Market::with('user')->orderBy('created_at', 'desc')->get();
        return new MarketResource($markets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        Auth::loginUsingId(1);
        $user_id = auth()->user()->id;
        $inputs['user_id'] = $user_id;

        Market::create($inputs);

        return response()->json([
            'data' => 'فروشگاه با موفقیت افزوده شد'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        return new ShowMarketResource($market);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Market $market)
    {
        $inputs = $request->all();

        $market->update($inputs);

        return response()->json([
            'data' => [
                'message' => 'فروشگاه با موفقیت ویرایش شد'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market)
    {
        $market->delete();

        return response()->json([
            'data' => 'فروشگاه با موفقیت حذف شد'
        ], 200);
    }
}
