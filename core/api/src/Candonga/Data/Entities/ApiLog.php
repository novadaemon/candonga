<?php

namespace Candonga\Data\Entities;

class ApiLog extends AbstractEntity
{
    protected $table = 'api_log';

    protected $dates = ['insert_at'];

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'insert_at',
        'level',
        'endpoint',
        'user',
        'message',
        'request',
        'response'
    ];

}
