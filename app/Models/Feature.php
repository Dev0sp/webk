<?php

namespace App\Models;

use CodeIgniter\Model;

class Feature extends Model
{
    /*=================================================================*/
    
    protected $table      = 'Feature';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ESP','Bullet', 'Aimbot','Item', 'Memory','Line','Health','Radar','Nobot','TeamID','AIM','BT','Hide'];
    
}