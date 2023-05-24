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