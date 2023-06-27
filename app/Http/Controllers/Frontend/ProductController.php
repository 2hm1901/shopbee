<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use Image;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function ShowProductList(){
        $id = Auth::id();
        $data = product::where('id_user', $id)->get()->toArray();
        // dd($data);
        

        return view('frontend.product.product-list', compact('data'));
    }
    public function ShowAddForm(){
        $brand = brand::all();
        $category = category::all();
        return view('frontend.product.product-add', compact('brand', 'category'));
    }
    public function AddProduct(ProductRequest $request){
        //check xem user da nhap anh vao chua
        if($request->hasfile('images'))
        {
            //kiem tra so luong anh user nhap vao
            if(count($request->file('images')) > 3){
                return back()->withErrors('Too much picture! Max is 3!');
            }
            else{
                //dung $request de lay het anh ra duoi dang array va dung vong for de lay tung anh ra
                foreach($request->file('images') as $image)
                {

                    //1 anh chia ra lam 3 loai anh
                    $name = $image->getClientOriginalName();
                    $name_2 = "hinh50_".$image->getClientOriginalName();
                    $name_3 = "hinh200_".$image->getClientOriginalName();

                    //$image->move('upload/product/', $name);
                    
                    $path = public_path('upload/product/' . $name);
                    $path2 = public_path('upload/product/' . $name_2);
                    $path3 = public_path('upload/product/' . $name_3);

                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                    Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                    
                    //$data dung de chua thong tin de day len database
                    $data[] = $name;
                 
                }
            }
        }
        $product= new product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_brand = $request->id_brand;
        $product->id_category = $request->id_category;
        $product->id_user = Auth::user()->id;
        $product->status = $request->status;
        $product->sale = $request->sale;
        $product->company = $request->company;
        $product->images=json_encode($data);
        $product->detail = $request->detail;
        $product->save();
        return back()->with('success', 'Your product has been added successfully');
    }
    public function ShowEditForm($id){
        $brand = brand::all();
        $category = category::all();
        $data = product::where('id',$id)->get();

        return view('frontend.product.product-edit', compact('data', 'brand', 'category'));
    }
    public function EditProduct(ProductRequest $request, $id){
        $imageWillBeDeleted = $request->delete_image;

        $data = product::where('id', $id)->pluck('images')->toArray();
        $imageCurrentExit = json_decode($data[0], true);

        if($imageWillBeDeleted){
            foreach($imageWillBeDeleted as $key => $value){
                if (in_array($value, $imageCurrentExit)) {
                    unlink('upload/product/hinh50_'.$value);
                    unlink('upload/product/hinh200_'.$value);
                    unlink('upload/product/'.$value);

                    $index = array_search($value, $imageCurrentExit);
                    unset($imageCurrentExit[$index]);
                    $imageCurrentExit = array_values($imageCurrentExit);
                }
            }
        }

        //check xem user da nhap anh vao chua
        if($request->hasfile('images'))
        {
            //kiem tra so luong anh user nhap vao
            $allowNumber = count($request->file('images')) + count($imageCurrentExit);
            if($allowNumber > 3){
                return back()->withErrors('Too much picture! Max is 3!');
            }
            else{
                //dung $request de lay het anh ra duoi dang array va dung vong for de lay tung anh ra
                foreach($request->file('images') as $image)
                {

                    //1 anh chia ra lam 3 loai anh
                    $name = $image->getClientOriginalName();
                    $name_2 = "hinh50_".$image->getClientOriginalName();
                    $name_3 = "hinh200_".$image->getClientOriginalName();

                    //$image->move('upload/product/', $name);
                    
                    $path = public_path('upload/product/' . $name);
                    $path2 = public_path('upload/product/' . $name_2);
                    $path3 = public_path('upload/product/' . $name_3);

                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                    Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                    
                    //$data dung de chua thong tin de day len database
                    $imageCurrentExit[] = $name;
                }
            }
        }
        product::where('id', $id)->update([
           'name' => $request->name,
            'price' => $request->price,
            'id_brand' => $request->id_brand,
            'id_category' => $request->id_category,
            'id_user' => Auth::user()->id,
            'status' => $request->status,
            'sale' => $request->sale,
            'company' => $request->company,
            'images'=>json_encode($imageCurrentExit),
            'detail' => $request->detail]
        );
        return back()->with('success', 'Your product has been edited successfully');
    }
    public function DeleteProduct($id){
        product::where('id', $id)->delete();
        return back()->with('success', 'Your product has been deleted successfully');
    }
    public function ShowProductDetail($id){
        $data = product::where('id',$id)->get()->toArray();
        return view('frontend.product.product-detail', compact('data'));
    }
}
