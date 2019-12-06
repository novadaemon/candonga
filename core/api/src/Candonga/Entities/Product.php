<?php

namespace Candonga\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends AbstractEntity
{
    use SoftDeletes;

    protected $table = 'products';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $attributes = [
        'status' => 'new'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'issn',
        'name',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::deleted(function($record){
            $record->update(['status', 'deleted']);
        });

    }
}
