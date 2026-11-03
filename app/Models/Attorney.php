<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Attorney extends Model
{
    protected $fillable=['photo','name','slug','practice','industry','location','title','designation','email','phone','linkedin_url','profile_pdf','overview','experience','experience_points','education','admissions', 'meta_title', 'meta_description', 'meta_keywords', 'robots'];
    public function capabilities(){return $this->belongsToMany(Capability::class);} public function blogPosts(){return $this->belongsToMany(BlogPost::class);}
}
