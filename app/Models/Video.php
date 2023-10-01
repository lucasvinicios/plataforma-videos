<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'titulo',
        'categoria_id',
        'descricao',
        'url',
    ];

    // public function run(): void {
    //     Video::factory()->count(10)->create();
    // }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
