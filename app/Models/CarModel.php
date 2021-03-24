<?php



namespace App\Models;

use CodeIgniter\Model;



class CarModel extends Model

{

    protected $DBGroup = 'default';

    protected $table      = 'tbl_car';

    protected $primaryKey = 'car_id';



    protected $returnType     = 'array';

    protected $useSoftDeletes = false;



    protected $allowedFields = ['car_id','car_noplate','make','model','color','rentalcompany','returndate','fuel_type','fuel_level','car_mileage', 'countrycode', 'gpstrackingnumber','year','created_timestamp','modified_timestamp'];



    protected $useTimestamps = false;

    

    protected $createdField  = 'created_at';

    protected $updatedField  = 'updated_at';

    protected $deletedField  = 'deleted_at';



    protected $validationRules    = [];

    protected $validationMessages = [];

    protected $skipValidation     = false;



    

    

}

?>

