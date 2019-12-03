<?php

namespace Core\Api\App\Data\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'issn',
        'customer_id',
        'status',
    ];

    public static function getFieldsWithNiceNames()
    {
        return [

        ];
    }

    public function customer()
    {
        return $this->belongsTo(Product::class);
    }
}
