<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Capability extends Model {
    protected $fillable = ['title','slug','description','page_title','page_description','image','hero_image','hero_image_mobile','experience','representative_matters','overview_heading','overview_image_left','overview_image_right','overview_paragraph_one','overview_paragraph_two', 'meta_title', 'meta_description', 'meta_keywords', 'robots'];

    public function getRouteKeyName() { return 'slug'; }

    public function resolveRouteBinding($value, $field = null) {
        $key = $field ?: $this->getRouteKeyName();
        return $this->where($key, $value)
            ->when(ctype_digit((string) $value), fn ($query) => $query->orWhere('id', (int) $value))
            ->firstOrFail();
    }

    public function attorneys() { return $this->belongsToMany(Attorney::class); }
    public function blogPosts() { return $this->belongsToMany(BlogPost::class); }
}
