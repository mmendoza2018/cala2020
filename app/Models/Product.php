<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "code",
        "description",
        "slug",
        "raffle_id",
        "digital_product",
        "documents",
        "min_stock",
        "promotion_links",
        "status_on_website",
        "status_on_catalog",
        "status",
        "product_brand_id",
        "measurement_unit_id",
        "category_product_id",
        "subcategory_product_id",
        "featured",
        "user_id"
    ];

    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id');
    }

    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class, 'measurement_unit_id');
    }

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function subcategoryProduct()
    {
        return $this->belongsTo(SubcategoryProduct::class, 'subcategory_product_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class, 'raffle_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
