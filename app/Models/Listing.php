<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ toevoegen
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory; // ✅ trait gebruiken
    //protected $fillable = [
      //  'company',
        //'title',
        //'location',
        //'website',
        //'email',
        //'tags',
        //'description',

    //];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('company', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('tags', 'like', '%' . $filters['search'] . '%');
            });
        }
    }
}