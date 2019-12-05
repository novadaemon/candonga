<?php

namespace Candonga\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Faker\Provider\Uuid;

class Customer extends AbstractEntity
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $dates = ['date_of_birth', 'created_at', 'updated_at', 'deleted_at'];

    protected $attributes = [
        'status' => 'new'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'status',
        'products'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function($record){
            $record->uuid = Uuid::uuid();
        });

        static::deleting(function($record){
            $record->status = 'deleted';
        });

    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value;
    }

    public function setProductsAttribute($values)
    {
        /**
         * Store ids send
         */
        $ids = [];

        foreach ($values as $id => $data)
        {
            $product = $this->products()->find($id);

            if($product == null){
                //New product, insert
                $product = Product::create(
                    ['customer_id' => $this->id] + $data
                );
                $ids[] = $product->id;
            }else{
                // Product exist, update
                $product->update($data);
                $ids[] = $id;
            }
        }

        //Remove customer products that no are in $ids
        if(!empty($ids))
            $this->products()->whereNotIn('products.id', $ids)
                ->delete();
    }
}
