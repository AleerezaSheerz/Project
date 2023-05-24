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