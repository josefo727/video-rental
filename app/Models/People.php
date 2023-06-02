<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class People extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'role'];

    protected $searchableFields = ['*'];

    public function videoPeople()
    {
        return $this->hasMany(VideoPerson::class);
    }

    public function allSeries()
    {
        return $this->hasMany(Series::class, 'main_person_id');
    }
}
