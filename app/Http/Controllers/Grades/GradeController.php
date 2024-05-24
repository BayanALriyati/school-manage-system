<?php 
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\StoreGrades;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    // جلب جميع السجلات من جدول الدرجات (Grades) باستخدام نموذج Grade(جلب البيانات من قاعدة البيانات)
    $Grades = Grade ::all();
    //يتم استخدام وظيفة compact لإنشاء مصفوفة تحتوي على البيانات المطلوبة
    return view("pages.Grades.Grades",compact('Grades')); 
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrades $request)
  {
    if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en',$request->Name_en)->exists()) {//(orWhere او)

      return redirect()->back()->withErrors(trans('Grades_trans.exists'));
    }
    try {
     $validated = $request->validated();
     $Grade = new Grade();
          
          $translations = [
              'en' => $request->Name_en,
              'ar' => $request->Name
          ];
          $Grade->setTranslations('Name', $translations);
          $Grade->Name = $request->Name;
          $translations = [
            'en' => $request->Notes_en,
            'ar' => $request->Notes
        ];
        $Grade->setTranslations('Notes', $translations);
          $Grade->Notes = $request->Notes;
          // $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
          // $Grade->Notes = ['en' => $request->Name_en, 'ar' => $request->Notes];
          $Grade->save();

          toastr()->success(trans('messages.success'));
          return redirect()->route('Grades.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
           
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrades $request)
  {
    // return $request ;
    try {
    $validated = $request->validated();
     $Grades = Grade::findOrFail($request->id);
          $Grades->update([
            $Grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
            $Grades->Notes = ['en' => $request->Name_en, 'ar' => $request->Notes] 
          ]);
          toastr()->success(trans('messages.Update'));
          return redirect()->route('Grades.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $Grades = Grade::findOrFail($request->id)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('Grades.index');
  }

  public function destroyAll()
{
    // Grade::truncate(); 
    DB::table('Grades')->delete();
    toastr()->error(trans('messages.Delete_all'));
    return redirect()->route('Grades.index');
}
  

}

?>