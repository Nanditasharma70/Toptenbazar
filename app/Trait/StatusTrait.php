<?php 
namespace App\Trait;

trait StatusTrait{
   
    #success code
    protected $success_code ="200";
    
    #error code
    protected $error_code ="400";
    
    #unauthorized code
    protected $unauthorized_code ="401";

    #Success message
    protected $success ="success";
    
    #Error message
    protected $error ="fail";

    #unauthorized message
    protected $unauthorized ="unauthorized";

    #Application Name
    protected $appname = "toptenbazar";

    #base url
    protected $imageBaseurl = "https://plvofc.s3.ap-south-1.amazonaws.com/";
   
}
?> 