<?php

namespace TomatoPHP\TomatoProducts\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use TomatoPHP\TomatoCategory\Models\Category;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $slug
 * @property string $sku
 * @property string $barcode
 * @property string $type
 * @property string $about
 * @property string $description
 * @property string $details
 * @property float $price
 * @property float $discount
 * @property string $discount_to
 * @property float $vat
 * @property boolean $is_in_stock
 * @property boolean $is_activated
 * @property boolean $is_shipped
 * @property boolean $is_trend
 * @property boolean $has_options
 * @property boolean $has_multi_price
 * @property boolean $has_unlimited_stock
 * @property boolean $has_max_cart
 * @property integer $min_cart
 * @property integer $max_cart
 * @property boolean $has_stock_alert
 * @property integer $min_stock_alert
 * @property integer $max_stock_alert
 * @property string $created_at
 * @property string $updated_at
 * @property Category[] $categories
 * @property Product[] $collection
 * @property Tags[] $tags
 * @property ProductMeta[] $productMetas
 * @property ProductReview[] $productReviews
 * @property Category $category
 */
class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = ['name', 'about', 'description', 'details'];

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'name', 'slug', 'sku', 'barcode', 'type', 'about', 'description', 'details', 'price', 'discount', 'discount_to', 'vat', 'is_in_stock', 'is_activated', 'is_shipped', 'is_trend', 'has_options', 'has_multi_price', 'has_unlimited_stock', 'has_max_cart', 'min_cart', 'max_cart', 'has_stock_alert', 'min_stock_alert', 'max_stock_alert', 'created_at', 'updated_at'];

    protected $casts = [
        'is_in_stock' => 'boolean',
        'is_activated'=> 'boolean',
        'is_shipped'=> 'boolean',
        'is_trend'=> 'boolean',
        'has_options'=> 'boolean',
        'has_multi_price'=> 'boolean',
        'has_unlimited_stock'=> 'boolean',
        'has_max_cart'=> 'boolean',
        'has_stock_alert' => 'boolean',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_has_categories');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collection()
    {
        return $this->belongsToMany('TomatoPHP\TomatoProducts\Models\Product', 'product_has_collection', 'collection_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Category::class, 'product_has_tags', null, 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productMetas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return mixed
     */
    public function meta(string $key, mixed $value=null): mixed
    {
        if($value !== null){
            return $this->productMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->productMetas()->where('key', $key)->first()?->value ?? null;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReviews()
    {
        return $this->hasMany('TomatoPHP\TomatoProducts\Models\ProductReview');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
