<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;
    protected $table = 'departaments';
    protected $primaryKey = 'departament_id';
    protected $attributes = [
        //'departament_id' => false,
        'name' => false,
        'leader' => false,
    ];
    protected $fillable = [
        'name' => 'required',
        'leader' => 'required',
    ];
    protected $casts = [
        'name' => 'string',
        'leader' => 'string',
    ];
    public static function create($departament_data)
    {

        $departament = new Departament([
            'name' => $departament_data['name'],
            'leader' => $departament_data['leader'],
        ]);
        $departament->save();
    }
}
