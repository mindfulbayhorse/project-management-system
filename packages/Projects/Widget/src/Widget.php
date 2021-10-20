<?php

namespace Projects\Widget;

use ReflectionClass;
use ReflectionProperty;
use Illuminate\Support\Str;

abstract class Widget{
    
    
    public function view(){
        
        return view("widgets.".$this->viewName());
        
    }
    
    protected function viewData(){
        
        $viewData = [];
        
        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property){
            $viewData[$property->getName()] = $property->getValue($this);
        }
        
        foreach ((new ReflectionClass($this))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method){
            
            if(!in_array($name = $method->getName(), ['view','render','__toString'])){
                $viewData[$name] = $this->$name();
            }
            
        }
        
        return $viewData;
        
    }
    
    public function viewName(){
        
        return Str::kebab(class_basename($this));
        
    }
    
    
    public static function render(){
        
        return new static;
        
    }
    
    
    public function __toString(){
                
        return $this->view()->with($this->viewData())->__toString();
        
    }
}