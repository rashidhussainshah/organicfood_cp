<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tag extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    public static  function getPopularTags()
    {
        return  DB::table('tags')
            ->select('id', DB::raw('count(*) as name_count, name'))
            ->groupBy('name')
            ->orderBy('name_count', 'desc')
            ->limit(5)
            ->get();
    }
}
