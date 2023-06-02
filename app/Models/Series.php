<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'main_person_id'];

    protected $searchableFields = ['*'];

    public function people()
    {
        return $this->belongsTo(People::class, 'main_person_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
