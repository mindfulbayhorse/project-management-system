<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class DeliverableRequest extends FormRequest
{
    
    protected $errorBag = 'deliverable';
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) return true; else return  abort(403);
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wbs_id' => 'required|integer',
            'title' => 'required',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'milestone' => 'nullable',
            'package' => 'nullable'
        ];
    }
}
