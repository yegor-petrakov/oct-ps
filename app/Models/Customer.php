<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        'name', 
        'number', 
        'note', 
        'user_id',
        'is_archived'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // public function sites()
    // {
    //     return $this
    //         ->belongsToMany(
    //             Site::class, 
    //             'customer_site', 
    //             'customer_id', 
    //             'site_id'
    //         )->withTimestamps();
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function contacts()
    // {
    //     return $this->hasMany(Contact::class);
    // }
}