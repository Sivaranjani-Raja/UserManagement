<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class UserDetail extends Model
{
    use HasFactory;

    use Searchable;


    protected $table = 'user_details';

    protected $fillable = [
        'email',
        'name',
        'date_of_join',
        'date_of_leave',
        'imagefile'    
    ];

    public function searchableAs()
    {
        return 'user_index';
    }
}
