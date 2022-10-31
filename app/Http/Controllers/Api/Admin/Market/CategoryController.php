<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\Market\CategoryResource;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get (
     *      path="/admin/market/category",
     *      operationId="GetProductCategories",
     *      tags={"Auth"},
     *      summary="get product categories",
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
        $productCategories = ProductCategory::orderBy('created_at', 'asc')->simplePaginate(3);
        return new CategoryResource($productCategories);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        //save to public folder
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->extension();
            $request->file('image')->move(public_path('product-category-images'), $imageName);

            if ($imageName == false) {
                return response()->json([
                    'data' => [
                        'message' => 'آپلود عکس با خطا مواجه شد'
                    ]
                ]);
            }
            //save to storage folder
            //$request->file('image')->storeAs('product-images', $imageName);

            $inputs['image'] = $imageName;

        }

        $category = ProductCategory::create($inputs);
        return response()->json([
            'data' => [
                'message' => 'دسته بندی جدید با موفقیت ثبت شد'
            ]
        ]);

        return new CategoryResource($category);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put (
     *      path="/admin/market/category/{id}",
     *      operationId="updateBrand",
     *      tags={"Category"},
     *      summary="update Brand by Id",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The ID of Brand",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *       ),
     *       @OA\RequestBody(
     *          required=true,
     *          description="Pass data",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="title",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="slug",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="image",
     *                  type="array",
     *                  @OA\Items(type="integer",example=1)
     *              ),
     *              @OA\Property(
     *                  property="abstract",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found Exception",
     *          @OA\JsonContent()
     *       ),
     *       security={{ "bearer_token": {} }}
     *     )
     */

    public function update(Request $request, ProductCategory $productCategory)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $destination = public_path('product-category-images');
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '_' . $request->file('image')->extension();
            $image->move(public_path('product-images'), $imageName);

            $productCategory->image = $imageName;

            $productCategory->save();
            return response()->json([
                'date' => [
                    'message' => 'محصول با موفقیت ویرایش شد'
                ]
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
    }
}
