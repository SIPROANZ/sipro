<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notacredito
 *
 * @property $id
 * @property $ejercicio_id
 * @property $cuentasbancaria_id
 * @property $beneficiario_id
 * @property $institucione_id
 * @property $montonc
 * @property $fecha
 * @property $referencianc
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Cuentasbancaria $cuentasbancaria
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Notacredito extends Model
{
    
    static $rules = [
		'ejercicio_id' => 'required',
		'cuentasbancaria_id' => 'required',
		'beneficiario_id' => 'required',
		'institucione_id' => 'required',
		'montonc' => 'required',
		'referencianc' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','cuentasbancaria_id','beneficiario_id','institucione_id','montonc','fecha','referencianc','descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancaria()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentasbancaria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejercicio()
    {
        return $this->hasOne('App\Ejercicio', 'id', 'ejercicio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucione_id');
    }
    

}
