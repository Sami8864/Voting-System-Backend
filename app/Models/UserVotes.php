<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVotes extends Model
{
    use HasFactory;

    protected $fillable=['user_id','party_id','election'];
}