<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Karyawan
 *
 * @property $id
 * @property $nama
 * @property $jabatan
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Karyawan extends Model
{
    use HasFactory;
    

    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nama', 'jabatan'];
    public $Sortable =['nama', 'jabatan'];



}
