<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['age_name'];
    protected $table = 'ages';
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('age_name', 'like', '%' . request('search') . '%');
        }
    }

}
