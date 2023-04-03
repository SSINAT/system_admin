<?php

namespace App\Services\Backend\Product;

use App\Repositories\ProductRepository;

/**
 * Class ProductUpdateService
 * @package App\Services
 */
class ProductUpdateService
{
    public function handle($request, $id)
    {
        $request->validate([
            'title' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:png,jpg',
            'desc' => 'required'
        ]);

        $product = (new ProductRepository)->getById($id);
        if (empty($product)) {
            # code...
            return redirect()->route('admin.product.index')->with('galat', 'Product Not Found');
        }

        if ($request->image) {
            # code...
            unlink(public_path('storage/image/' . $product->image));

            $file = $request->file('image');
            $imageName = time() . '.' . $file->extension();

            $data = [
                'name' => $request->title,
                'price' => $request->harga,
                'body' => $request->desc,
                'image' => $imageName,
                'status' => $request->status,
                'slug' => str_replace(' ', '-', $request->title)
            ];

            (new ProductRepository)->update($data, $id);

            $file->storeAs('public/image/', $imageName);
        } else {
            # code...
            $data = [
                'name' => $request->title,
                'price' => $request->harga,
                'body' => $request->desc,
                'status' => $request->status,
                'slug' => str_replace(' ', '-', $request->title)
            ];

            (new ProductRepository)->update($data, $id);
        }

        return redirect()->route('admin.product.index')->with('success', 'Product Hass Been Update');
    }
}
