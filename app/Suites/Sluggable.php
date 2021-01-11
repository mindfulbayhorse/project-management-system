<?php 
namespace App\Suites;

use App\Models\SectionTitle;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait Sluggable{
    
    /*
     * get unique slug if the title is already in use
     */
    public function createUniqueSlug(string $title, string $key = 'title'): string
    {
        $slug = Str::of($title)->slug('-');
        if (static::where('slug', $slug)->exists()){
            $latest = $this->where($key, $title)->latest('id')->value('slug');
            $inc = $this->getIncrement($latest);
            $slug = $slug.'-'.$inc;
        }
        
        return $slug;
    }
    
    /*
     * get the slug with incremented last number
     */
    public function getIncrement(string $slug): int
    {
        $inc = 1;
        $slugParts = explode('-', $slug);
        if (count($slugParts)>0){
            $number = end($slugParts);
            if (intval($number)>0){
                return $number++;
            }
        }
        
        return $inc;
    }
}