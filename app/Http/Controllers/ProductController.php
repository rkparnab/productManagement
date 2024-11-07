<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();


        if ($request->filled('search')) {
            $query->where('product_id', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }


        if ($request->filled('sort_by')) {
            $query->orderBy($request->sort_by, 'asc');
        }

        $products = $query->paginate(10);
        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:products',

            'name' => 'required',

            'price' => 'required|numeric',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        // Product::create($request->all());

        if($request->hasFile('image')){

            $image=$request->file('image');
            $imageName='arnab'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
        }
        else{

            $imageName=null;
        }

        Product::create([
             'product_id'=> $request->input('product_id'),
              'name'=> $request->input('name'),
               'price'=>$request->input('price'),
               'image'=>$imageName,

        ]);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required',
//             'price' => 'required|numeric',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
//         ]);

//         $product = Product::findOrFail($id);
//         $data = $request->all();


//         if ($request->hasFile('image')) {

//             if ($product->image) {
//                 $oldImagePath = public_path('images/' . $product->image);
//                 if (file_exists($oldImagePath)) {
//                     unlink($oldImagePath);
//                 }
//             }

//             $imageName = time().'.'.$request->image->extension();
//             $request->image->move(public_path('images/'), $imageName);
//             $data['image'] = $imageName;
//         } else {
//             $data['image'] = $product->image;
//         }

//         $product->update($data);
//         return redirect()->route('products.index')->with('success', 'Product updated successfully.');
// }


                // update Page
public function update($id, Request $request){

    $product =Product::findOrFail($id);

    $rules = [

        'name' => 'required',

            'price' => 'required|numeric',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
           ];

        if($request->image !=""){

            $rules['image'] = 'image';
        }



            $validator = validator::make($request->all(),$rules);

            if ($validator->fails()) {

               return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);

            }

        // ---- here insert  product update in DB

        $product = new Product();

        $product->name = $request->name;

        $product->price = $request->price;

        $product->description = $request->description;

        $product->save();

        if($request->image != ""){

         // delete old image

    File::delete(public_path('uploads/products/' .$product->image));

        // ---store image

        $image= $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;

        // ---save image product directory
        $image->move(public_path('uploads/products/'), $imageName);

        // save image name in database
        $product->image = $imageName;
        $product->save();

        }

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully.');


}


public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
