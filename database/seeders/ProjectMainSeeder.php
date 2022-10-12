<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Deliverable;
use App\Models\Status;

class ProjectMainSeeder extends Seeder
{
    private $faker;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //$this->faker = \Faker\Factory::create();
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
                ->state([
                    'wbs_id'=>$project->wbs()->actual()[0]->id,
                    'start_date' => fake()->dateTimeBetween('-1 month', '+1month'),
                    'end_date' => fake()->dateTimeBetween('+2 months','+1 year')
                ])
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
        
        Deliverable::factory()->state([
                'title'=>'Content',
                'start_date' => fake()->dateTimeThisYear('-1 month'),
                'end_date' => fake()->dateTimeThisYear('+2 months')
            ])
            ->forWBS(['project_id'=>$project->id, 'actual'=>1])
            ->create();
        
    }
}
