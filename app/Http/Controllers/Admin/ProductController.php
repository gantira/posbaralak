<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Product/Index', [
            'products' => Product::all()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image_link' => $product->image_link,
                    'description' => $product->description,
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Product/Create', [
            'categories' => Category::select('id', 'name')->get(),
            'statuses' => Status::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'name' => 'required|unique:products,name',
            'price' => 'required|integer',
            'description' => 'nullable|min:3|max:255',
            'image' => 'nullable|image',
        ]);

        if ($request->file('image')) {
            $image = Storage::disk('public')->put('images', $request->file('image'));
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image ?? null,
        ]);

        $product->categories()->sync($request->category_id);
        $product->statuses()->sync($request->status_id);

        session()->flash('message', 'Product created succesfully.');
        session()->flash('type', 'success');

        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'category_id' => $product->categories()->first()->id,
                'status_id' => $product->statuses()->first()->id,
                'image' => $product->image,
                'image_link' => $product->image_link,
            ],
            'categories' => Category::select('id', 'name')->get(),
            'statuses' => Status::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'name' => 'required|unique:products,name,' . $product->id,
            'price' => 'required|integer',
            'description' => 'nullable|min:3|max:255',
            'image' => 'nullable|image',
        ]);

        if ($request->file('image')) {
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $image = Storage::disk('public')->put('images', $request->file('image'));
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image ?? $product->image,
        ]);

        $product->categories()->sync($request->category_id);
        $product->statuses()->sync($request->status_id);

        session()->flash('message', 'Product has been updated.');
        session()->flash('type', 'info');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        session()->flash('message', 'Product has been deleted.');
        session()->flash('type', 'info');

        return redirect(route('admin.products.index'));
    }
}
