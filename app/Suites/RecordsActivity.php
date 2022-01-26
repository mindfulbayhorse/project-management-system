<?php 
namespace App\Suites;

use Carbon\Carbon;

trait RecordsActivity{
    
    public $oldAttributes = [];
    
    public static function bootRecordsActivity(){
        
        foreach(self::recordableEvents() as $event){
            
            static::$event(function ($model) use ($event){
                
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

        return "{$description}_".strtolower(class_basename($this));

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
            'wbs_id'=> class_basename($this) === 'WorkBreakdownStructure' ? $this->id : $this->wbs->id,
            'description' => $description,
            'changes' => $this->activityChanges()
        ]);
        
    }
    
    public function activityChanges()
    {
        
        $before = $this->cleanTimestamps($this->oldAttributes);
        $after = $this->cleanTimestamps($this->getAttributes());
        $changes = $this->cleanTimestamps($this->getChanges());
       
        $filtered = $this->filterFieldValues(compact(array('before', 'after', 'changes')));
        extract($filtered);
       
        
        if ($this->wasChanged()){
            return [
                'before' => array_diff($before, $after),
                'after' => $changes
            ];
        }
        
        return null;
        
    }
    
    private function filterFieldValues(Array $fieldSet){
        
        $filtered = [];
        foreach($fieldSet as $key => $fields){
            
            
            $filtered[$key] = array_map(function($value){
                
                if (is_object($value)){
                    
                    if (get_class($value)=='DateTime')
                        
                        $value = new Carbon($value);
                        
                        return $value->getTimestamp();
                }

                return $value;
            }, $fields);
        }

        return $filtered;
    }
    
    
    private function cleanTimestamps($origin){
        
        if (isset($origin['updated_at'])){
            unset($origin['updated_at']);
        }
           
        if (isset($origin['created_at'])){
            
            unset($origin['created_at']);
        }
        
        return $origin;
        
    }
}