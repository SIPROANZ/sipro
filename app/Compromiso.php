<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compromiso
 *
 * @property $id
 * @property $analisi_id
 * @property $unidadadministrativa_id
 * @property $codigo
 * @property $fecha
 * @property $estatus
 * @property $created_at
 * @property $updated_at
 *
 * @property Analisi $analisi
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Compromiso extends Model
{
    
    static $rules = [
		'analisi_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'codigo' => 'required',
		'fecha' => 'required',
		'estatus' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['analisi_id','unidadadministrativa_id','codigo','fecha','estatus'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function analisi()
    {
        return $this->hasOne('App\Analisi', 'id', 'analisi_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    

}
