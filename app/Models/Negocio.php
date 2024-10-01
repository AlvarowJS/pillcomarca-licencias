<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Negocio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombrenegocio',
        'ruc',
        'direccion',
        'metroscuadrados',
        'monto',
        'nLicencia',
        'nExpediente',
        'fecha',
        'lugar',
        'manzana',
        'lote',
        'razonsocial',
        'subcategoria_id',
        'administrado_id',
        'actividad_economica_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
     
    ];

    public function subcategoria(): BelongsTo
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function administrado(): BelongsTo
    {
        return $this->belongsTo(Administrado::class);
    }

    public function actividad_economica(): BelongsTo
    {
        return $this->belongsTo(ActividadEconomica::class);
    }
}
