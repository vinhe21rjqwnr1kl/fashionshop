<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['locale', 'name', 'description','content'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
