<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['brand_name'];
    protected $table = 'brands';
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('brand_name', 'like', '%' . request('search') . '%');
        }
    }

}
