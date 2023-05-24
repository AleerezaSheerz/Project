// 1. #Define Course ( دوره ) & Lesson ( درس ) in CLI ( Terminal ) :
```
php artisan make:model دوره
php artisan make:model درس
```
// 2. #Edit Models : app/Models/دوره.php و app/Models/درس.php  

```php
// app/Models/دوره.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
‎        'نام',
‎        'قیمت',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
```

```php
// app/Models/درس.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
‎        'نام',
‎        'قیمت',
‎        'کد دوره',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
```

// 3. #Make 2 Routes in routes/web.php :

```php
use App\Models\دوره;
use App\Models\درس;
use Illuminate\Http\Request;

Route::post('/courses/{course}/lessons', function (Course $course, Request $request) {
    $data = $request->validate([
‎        'نام' => 'required|string',
‎        'قیمت' => 'required|numeric',
    ]);

    $lesson = new Lesson($data);
    $lesson->course()->associate($course);
    $lesson->save();

    return response()->json([
        'message' => 'درس با موفقیت اضافه شد',
        'data' => $lesson,
    ], 201);
});

Route::patch('/courses/{course}', function (Course $course, Request $request) {
    $data = $request->validate([
‎        'قیمت' => 'required|numeric',
    ]);

    $course->update($data);

    return response()->json([
        'message' => 'دوره با موفقیت اضافه شد',
        'data' => $course,
    ]);
});
```  