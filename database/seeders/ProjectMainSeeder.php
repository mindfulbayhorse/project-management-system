<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Deliverable;
use App\Models\WorkBreakdownStructure;
use App\Models\Status;

class ProjectMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->seedProjectsWithStatus();
        $this->seedMainProject();
        
    }
    
    function truncateStatuses() {
        
        $statuses = Status::all();
        
        foreach($statuses as $status){
            if($status->projects){
                Project::destroy($status->projects->pluck('id'));
            }
            $status->delete();
        }
        
    }
    
    
    function seedProjectsWithStatus() {
        
        $this->truncateStatuses();
        $projects = Project::all();
        
        foreach($projects as $project){
            $project->delete();
        }

        $projects = Project::factory()
            ->for(Status::factory())
            ->count(4)->create();   
            
        $this->seedDeliverablesForProjectsWBS($projects);
        
    }
    
    function seedDeliverablesForProjectsWBS($projects){
        
        foreach ($projects as $project){
           
            Deliverable::factory()
                ->count(50)
                ->state(['wbs_id'=>$project->wbs()->actual()[0]->id])
                ->create();
        }
    }
    
    function seedMainProject(){
        
        $status = Status::where(['name'=>'Initialized'])->first();
        Project::where(['title' =>'Beadshine'])->delete();
        
        if($status){
            
            $project = Project::factory([
                'title'=>'Beadshine',
                'status_id'=>$status->id
            ])->create();
            
        } else {
            $project = Project::factory(['title'=>'Beadshine'])
                ->for(Status::factory()->state(['name'=>'Initialized']))
                ->create();
        }
        
        Deliverable::factory()->state(['title'=>'Content'])
            ->forWBS(['project_id'=>$project->id, 'actual'=>1])
            ->create();
        
    }
}
