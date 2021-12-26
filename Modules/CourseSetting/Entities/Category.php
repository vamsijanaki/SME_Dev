<?php

namespace Modules\CourseSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\Quiz\Entities\OnlineQuiz;

class Category extends Model
{


    protected $fillable = ['name', 'status', 'show_home', 'position_order', 'image', 'thumbnail'];

    protected $appends = ['courseCount'];


    public function subcategories()
    {

        return $this->hasMany(Category::class, 'parent_id', 'id')->select('id', 'parent_id', 'name')->orderBy('position_order');
    }

    public function activeSubcategories()
    {

        return $this->hasMany(Category::class, 'parent_id', 'id')->select('id', 'parent_id', 'name')->where('status', 1)->orderBy('position_order');
    }

    public function courses()
    {

        return $this->hasMany(Course::class, 'category_id', 'id')->where('status', 1);
    }

    public function getcourseCountAttribute()
    {
        return $this->courses()->count();
    }

    public function totalCourses()
    {
        return $this->courses()->count();
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name) == "" ? str_replace(' ', '-', $this->name) : Str::slug($this->name);
    }


    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('categories');
        });
        self::updated(function ($model) {
            Cache::forget('categories');
        });
        self::deleted(function ($model) {
            Cache::forget('categories');
        });
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('childs');
    }

    public function quizzesCategoryCount()
    {
        return $this->hasMany(OnlineQuiz::class, 'category_id', 'id');
    }

    public function quizzesSubCategoryCount()
    {

        return $this->hasMany(OnlineQuiz::class, 'sub_category_id', 'id');
    }


    public function getQuizzesCountAttribute()
    {
        if (!$this->relationLoaded('quizzesCategoryCount')) {
            $this->load('quizzesCategoryCount');
        }
        if (!$this->relationLoaded('quizzesSubCategoryCount')) {
            $this->load('quizzesSubCategoryCount');
        }
        return $this->quizzesCategoryCount->count() + $this->quizzesSubCategoryCount->count();
    }

    public function totalEnrolled()
    {
        return $this->hasManyThrough('Modules\CourseSetting\Entities\Course', 'Modules\CourseSetting\Entities\CourseEnrolled', 'course_id', 'id');

    }

}
