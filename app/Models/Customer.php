<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    /**
     * table
     *
     * @var string
     */
    protected $table = 'customer';


    /**
     * dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'apellidos',
        'identificacion',
        'correo'

    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
