<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
{
    use HasFactory;

    protected $table = "sites";

    protected $fillable = [
        'name',
        'address',
        'note', 
        'is_archived'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_archived' => 'boolean'
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

    public function customers()
    {
        return $this
            ->belongsToMany(
                Customer::class, 
                'customer_site', 
                'site_id', 
                'customer_id'
            )->withTimestamps();
    }

    // public function requests() { 
    //     return $this->hasMany(Request::class); 
    // }

    // public function contacts()
    // {
    //     return $this->belongsToMany(Contact::class, 'site_contact');
    // }
}   