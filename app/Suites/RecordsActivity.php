<?php 
namespace App\Suites;

trait RecordsActivity{
    
    public $oldAttributes = [];
    
    public static function bootRecordsActivity(){
        
        
        
        foreach(self::recordableEvents() as $event){
            
            static::$event(function ($model) use ($event){
                
                //dd($model, $event);
                $model->recordActivity($model->activityDescription($event));
                
            });
            
            if ($event === 'updated'){
                static::updating(function($model){
                    
                    $model->oldAttributes = $model->getOriginal();
                    
                });
            }
            
            
        }   
    }
    
    protected function activityDescription($description){

        //dd(class_basename($this));
        if(class_basename($this) !== 'WorkBreakdownStructure'){
            return "{$description}_".strtolower(class_basename($this));
        }
        
        return $description;
    }
    
    protected static function recordableEvents(){
        
        if (isset(static::$recordableEvents)){
            return static::$recordableEvents;
        } 
        
        return ['created', 'updated', 'deleted'];
        
    }
    
    public function recordActivity($description)
    {
        
        $this->activities()->create([
            'wbs_id'=> class_basename($this) === 'WorkBreakdownStructure' ? $this->id : $this->projectWBS->id,
            'description' => $description,
            'changes' => $this->activityChanges()
        ]);
        
    }
    
    public function activityChanges()
    {
        if ($this->wasChanged()){
            return [
                'before' => array_diff($this->oldAttributes,$this->getAttributes()),
                'after' => $this->getChanges()
            ];
        }
        
        return null;
        
    }
    
}