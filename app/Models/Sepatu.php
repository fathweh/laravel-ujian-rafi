<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepatu extends Model
{
    use HasFactory;

    protected $fillable = ['id','nama_sepatu','foto'];
    public $timestamp = true;

    public function deleteImage(){
        if ($this->foto && file_exists(public_path('storage/sepatu' . $this->foto))) {
            return unlink(public_path('storage/sepatu' . $this->foto));
        }
    }
}
