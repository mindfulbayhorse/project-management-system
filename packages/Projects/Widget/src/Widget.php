<?php

namespace Projects\Widget;

use ReflectionClass;
use ReflectionProperty;
use Illuminate\Support\Str;

abstract class Widget{
    
    public function loadView(){
        
        return $this->view()->with($this->buildViewData());
    }
    
    public function view(){
        
        return view("widgets.".$this->viewName());
        
    }
    
    public static function render(){
        
        return (new static)->loadView();
    }
    
    protected function buildViewData(){
        
        $viewData = [];
        
        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property){
            $viewData[$property->getName()] = $property->getValue($this);
        }
        
        foreach ((new ReflectionClass($this))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method){
            
            if(!in_array($name = $method->getName(), ['loadView','view','render'])){
                $viewData[$name] = $this->$name();
            }
            
        }
        
        return $viewData;
        
    }
    
    public function viewName(){
        
        return Str::kebab(class_basename($this));
        
    }
}