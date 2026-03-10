<?php 
 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
 
class Product extends Model 
{ 
    // Champs autorisés à l'écriture 
    protected $fillable = [ 
        'name', 
        'description', 
        'price', 
        'stock', 
        'category', 
    ];
}