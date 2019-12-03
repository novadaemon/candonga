<?php

namespace Core\Api\App\Data\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = 'customers';

    public $dates = ['created_at', 'updated_at', 'deleted_at', 'date_of_birth'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'date_of_birth',
        'status'
    ];

    public static function getFieldsWithNiceNames()
    {
        return [

        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
