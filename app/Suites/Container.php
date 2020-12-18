<?php 
namespace App\Suites;

class Container{
    
    protected $bindings = [];
    
    public function bind($key, $value){
        $this->bindings[$key] = $value;
    }
    
    public function resolve($key){
        
        if(!empty($this->bindings[$key])){
            return call_user_func($this->bindings[$key]);
        }
    }
}
?>
