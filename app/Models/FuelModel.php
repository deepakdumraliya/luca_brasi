<?php
namespace App\Models;
use CodeIgniter\Model;

class FuelModel extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'fuel';
    protected $primaryKey = 'fuel_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fuel_id','day_id','user_id','kilometer','zipcode','fuel_amount','amount','oil_status','blue_tanked_status','created','modified'];

    protected $useTimestamps = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    
    
}
?>