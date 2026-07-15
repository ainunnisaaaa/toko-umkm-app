<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductService
{
    /**
     * Handle business logic for storing a new product.
     *
     * @param array $data Validated request data
     * @param UploadedFile|null $image Image file if uploaded
     * @param int $storeId ID of the store the product belongs to
     * @param bool $isActive Whether the product is active
     * @return Product
     */
    public function createProduct(array $data, ?UploadedFile $image, int $storeId, bool $isActive): Product
    {
        if ($image) {
            $data['image'] = $image->store('products', 'public');
        }

        $data['is_active'] = $isActive;
        $data['store_id'] = $storeId;
        $data['rating'] = 0; // Default rating for new product

        return Product::create($data);
    }

    /**
     * Handle business logic for updating an existing product.
     *
     * @param Product $product The product to update
     * @param array $data Validated request data
     * @param UploadedFile|null $image Image file if uploaded
     * @param bool $isActive Whether the product is active
     * @return Product
     */
    public function updateProduct(Product $product, array $data, ?UploadedFile $image, bool $isActive): Product
    {
        if ($image) {
            $data['image'] = $image->store('products', 'public');
            // Optional: Handle old image deletion here if needed
        }

        $data['is_active'] = $isActive;

        $product->update($data);
        return $product;
    }
}
