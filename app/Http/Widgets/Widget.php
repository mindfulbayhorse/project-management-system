<?php 

namespace App\Http\Widgets;

use ReflectionClass;
use ReflectionProperty;
use Illuminate\Support\Str;

abstract class Widget{
    
    public function loadView(){
        
        return $this->view()->with($this->buildViewData());
    }
    
    public function view(){
        
        $name = (Str::kebab(class_basename($this)));
        return view("widgets.{$name}");
        
    }
    
    protected function buildViewData(){
        
        $viewData = [];
        
        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property){
            $viewData[$property->getName()] = $property->getValue($this);
        }
        
        return $viewData;
       
    }
}