<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
    protected $fillable = ['kode_barang', 'nama_barang', 'kategori_barang', 'lokasi_barang'];

    public function mutasi(): HasMany
    {
        return $this->hasMany(Mutasi::class, 'kodeBarang', 'kode_barang');
    }
}
