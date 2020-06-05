<?php

namespace App\Http\Controllers\Api;
use App\Events\AddNewProduct;
use App\Events\SendOperationOnProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new ProductResource::collect($product);
        $products = Product::get();
        return response()->json(['status'=>true,'products'=>$products],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product                 = new Product();
        $product->name           = $request->name;
        $product->price          = $request->price;
        $product->description    = $request->description;
        $imageName = "/uploads/".time().'.'.$request->main_image->getClientOriginalExtension();
        $request->main_image->move(public_path('uploads'), $imageName);
        $product->main_image     = $imageName;
        $product->save();
        $status  = 'added';
        broadcast(new SendOperationOnProduct($status,$product,$product->name))->toOthers();
        return response()->json(['status'=>true,'product'=>$product],200); //can use resource
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (isset($product)){
           // return new ProductResource($product);
          return  response()->json(['status'=>true,'product'=>$product],200); //can use resource
        }
        return response()->json(['status'=>false,'msg'=>'not found ,try again']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product =Product::find($id);
        if (isset($product)){
          return  response()->json(['status'=>true,'product'=>$product]);
        }
        return response()->json(['status'=>false,'msg'=>'not found ,try again']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!isset($product)){
           return response()->json(['status'=>false,'msg'=>'no product,try again']); //can use resource
        }
        $product->name           = $request->name;
        $product->price          = $request->price;
        $product->description    = $request->description;
        if ($request->main_image){
            $imageName = "/uploads/".time().'.'.$request->main_image->getClientOriginalExtension();
            $request->main_image->move(public_path('uploads'), $imageName);
            $product->main_image     = $imageName;
        }
        $product->save();
        $status  = 'updated';
        broadcast(new SendOperationOnProduct($status,$product))->toOthers();
        return response()->json(['status'=>true,'msg'=>'updated successfully','product'=>$product],200); //can use resource
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (isset($product)){
            $status  = 'deleted';
            broadcast(new SendOperationOnProduct($status,$product))->toOthers(); //broadcasting to product-index channels
            $product->delete();
           return response()->json(['status'=>true,'msg'=>'deleted successfully']);
        }
        return response()->json(['status'=>false,'msg'=>'not found ,try again']);
    }
}
