<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Models\Product;

/**
 * Class ProductRepository.
 */
class ProductRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getAll()
    {
        return Product::with('category')->paginate(5);
    }

    public function countStatus()
    {
        return [
            'publish' => count(Product::where('status', 'publish')->get()),
            'draft' => count(Product::where('status', 'draft')->get())
        ];
    }

    public function searchKategori($request)
    {
        $search = $request->q;
        return Categorie::select("id", "name")
            ->where('name', 'LIKE', "%$search%")
            ->get();
    }

    public function store($data)
    {
        return Product::create($data);
    }

    public function getById($id)
    {
        return Product::with('category')->find($id);
    }

    public function update($data, $id)
    {
        return $this->getById($id)->update($data);
    }
}
