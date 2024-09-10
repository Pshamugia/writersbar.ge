<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Categories;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuizzController extends Controller
{
    public function admin_quizz(Request $request)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        if (request()->has('hide'))

            Quizz::where('id', $request->id)->update([
                'hidden' => 1
            ]);

        if (request()->has('show'))

            Quizz::where('id', $request->id)->update([
                'hidden' => 0
            ]);

        $quizz_view = Quizz::orderBy('id', 'DESC')->get();
        $question_view = Question::orderBy('id', 'DESC')->get();


        return view('admin/quizz/quizz_view', ['quizz_view' => $quizz_view, 'question_view' => $question_view]);
    }

public function events_quizz(Request $request)
    {

        $quizz_view = Quizz::where('hidden', '0')->orderBy('id', 'DESC')->get();

        return view('events_quizz', ['quizz_view' => $quizz_view]);
    }



    public function quizz_results(Request $request)
    {
        echo DB::table('quizz_results')->insertGetId([
            'quizz_id' => $request->quizz_id,
            'scores' => $request->correct_answers
        ]);
    }



    public function quizz_full($id, $mainTitle_ka)
    {
        $quizz_full = Quizz::where('id', $id)
            ->select(
                [
                    'id',
                    'mainTitle_ka',
                    'mainDescription_ka',
                    'question_ka',
                    'answerOne_ka',
                    'answerTwo_ka',
                    'answerThree_ka',
                    'feedbackOne_ka',
                    'feedbackTwo_ka',
                    'feedbackThree_ka',
                    'feedbackFour_ka',
                    'upload'
                ]
            )->first();



        $quizz_questions = Question::where('id', $id)
            ->select(
                [
                    'id',
                    'question_ka',
                    'answerOne_ka',
                    'answerTwo_ka',
                    'answerThree_ka',
                    'upload'
                ]
            )->first();

        $categories = Categories::get();

        $quizz_time = Quizz::where('id', $id)->orderBy('created_at', 'DESC')->get();

        $result = null;
        $quizz_result = null;
        if (request()->has('result')) {
            $result = DB::table('quizz_results')->where('id', request()->result)->first();

            if ($result) {
                if ($result->scores <= 3) {
                    $upload = 'upload1 as upload';
                    $description = 'feedbackOne_ka as description';
                } else if ($result->scores > 3 &&  $result->scores <= 6) {
                    $upload = 'upload2 as upload';
                    $description = 'feedbackTwo_ka as description';
                } else if ($result->scores > 6 && $result->scores <= 9) {
                    $upload = 'upload3 as upload';
                    $description = 'feedbackThree_ka as description';
                } else if ($result->scores > 9) {
                    $upload = 'upload4 as upload';
                    $description = 'feedbackFour_ka as description';
                }
                $quizz_result = Quizz::select([
                    $upload,
                    $description,
                ])
                    ->selectRaw(request()->result . ' as result_id')
                    ->where('id', $result->quizz_id)
                    ->first();
            }
        }

        $count = Question::where('quizz_id', $id)->count();



        $related = Quizz::where('id', '!=', $id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('quizz', [
            'quizz_full' => $quizz_full,
            'categories' => $categories,
            'quizz_questions' => $quizz_questions,
            'quizz_result' => $quizz_result,
            'quizz_time' => $quizz_time,
            'related' => $related,
            'count' => $count
        ]);
    }


    public function add_quizz()
    {

        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }



        $add_quizz = Quizz::orderBy('id', 'DESC')->get();

        return view('admin/quizz/add_quizz', ['add_quizz' => $add_quizz]);
    }


    public function store(Request $request)
    {
        $filename = '';
        if ($request->hasFile('upload')) {
            $myimage = $request->upload->getClientOriginalName();
            $imgFile = Image::make($request->upload->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename = 'uploads/' . $myimage;
        }

        $filename1 = '';
        if ($request->hasFile('upload1')) {
            $myimage = $request->upload1->getClientOriginalName();
            $imgFile = Image::make($request->upload1->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename1 = 'uploads/' . $myimage;
        }


        $filename2 = '';
        if ($request->hasFile('upload2')) {
            $myimage = $request->upload2->getClientOriginalName();
            $imgFile = Image::make($request->upload2->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename2 = 'uploads/' . $myimage;
        }


        $filename3 = '';
        if ($request->hasFile('upload3')) {
            $myimage = $request->upload3->getClientOriginalName();
            $imgFile = Image::make($request->upload3->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename3 = 'uploads/' . $myimage;
        }


        $filename4 = '';
        if ($request->hasFile('upload4')) {
            $myimage = $request->upload4->getClientOriginalName();
            $imgFile = Image::make($request->upload4->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename4 = 'uploads/' . $myimage;
        }


        $quizz_me = Quizz::make();
        $quizz_me->mainTitle_ka = $request->mainTitle_ka;
        $quizz_me->mainTitle_en = $request->mainTitle_en;
        $quizz_me->mainDescription_ka = $request->mainDescription_ka;
        $quizz_me->mainDescription_en = $request->mainDescription_en;
        $quizz_me->feedbackOne_ka = $request->finalFeedbackOne_ka;
        $quizz_me->feedbackTwo_ka = $request->finalFeedbackTwo_ka;
        $quizz_me->feedbackThree_ka = $request->finalFeedbackThree_ka;
        $quizz_me->feedbackFour_ka = $request->finalFeedbackFour_ka;
        $quizz_me->upload = $filename;
        $quizz_me->upload1 = $filename1;
        $quizz_me->upload2 = $filename2;
        $quizz_me->upload3 = $filename3;
        $quizz_me->upload4 = $filename4;
        $quizz_me->save();


        $index = 0;
        foreach ($request->name_id as $k => $v) {
            $question_ka = $request->question_ka[$index];
            $feedbackOne_ka = $request->feedbackOne_ka[$index];
            $feedbackTwo_ka = $request->feedbackTwo_ka[$index];
            $feedbackThree_ka = $request->feedbackThree_ka[$index];


            $answerOne_ka = $request->answerOne_ka[$index];
            //$answerOne_en = $request->answerOne_en[$index];
            $answerTwo_ka = $request->answerTwo_ka[$index];
            //$answerTwo_en = $request->answerTwo_en[$index];
            $answerThree_ka = $request->answerThree_ka[$index];
            // $answerThree_en = $request->answerThree_en[$index];

            $correct = $request->get('correct_' . $v);

            $filename = '';
            if ($request->hasFile('uploadFeedback_' . $index)) {
                $myimage = $request->file('uploadFeedback_' . $index)->getClientOriginalName();
                $imgFile = Image::make($request->file('uploadFeedback_' . $index)->getRealPath());
                $imgFile->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $myimage));

                //$myimage = $request->upload->getClientOriginalName();
                //$request->upload->move(public_path('uploads'), $myimage);

                $filename = 'uploads/' . $myimage;
            }

            $question = Question::make();
            $question->quizz_id = $quizz_me->id;
            $question->question_ka = $question_ka;
            $question->answerOne_ka = $answerOne_ka;
            $question->answerTwo_ka = $answerTwo_ka;
            $question->answerThree_ka = $answerThree_ka;
            $question->feedbackOne_ka = $feedbackOne_ka;
            $question->feedbackTwo_ka = $feedbackTwo_ka;
            $question->feedbackThree_ka = $feedbackThree_ka;
            $question->correct = $correct;
            $question->upload = $filename;
            $question->save();

            $index++;
        }

        return redirect()->route('admin.quizz');
    }


    public function quizz_delete($id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        Quizz::where('id', $id)->delete();

        return redirect()->route('admin.quizz');
    }





    public function quizz_edit($id)
    {

        $view_quizz = Quizz::where('id', $id)->orderBy('id', 'desc')->first();

        return view('admin/quizz/edit', [
            'view_quizz' => $view_quizz
        ]);
    }


    public function quizz_update(Request $request, $id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $filename = '';
        if ($request->hasFile('upload')) {
            $myimage = $request->upload->getClientOriginalName();
            $imgFile = Image::make($request->upload->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename = 'uploads/' . $myimage;
        }

        $filename1 = '';
        if ($request->hasFile('upload1')) {
            $myimage = $request->upload1->getClientOriginalName();
            $imgFile = Image::make($request->upload1->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename1 = 'uploads/' . $myimage;
        }


        $filename2 = '';
        if ($request->hasFile('upload2')) {
            $myimage = $request->upload2->getClientOriginalName();
            $imgFile = Image::make($request->upload2->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename2 = 'uploads/' . $myimage;
        }


        $filename3 = '';
        if ($request->hasFile('upload3')) {
            $myimage = $request->upload3->getClientOriginalName();
            $imgFile = Image::make($request->upload3->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename3 = 'uploads/' . $myimage;
        }


        $filename4 = '';
        if ($request->hasFile('upload4')) {
            $myimage = $request->upload4->getClientOriginalName();
            $imgFile = Image::make($request->upload4->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename4 = 'uploads/' . $myimage;
        }


        $quizz_update = Quizz::where('id', $id)->first();
        $quizz_update->mainTitle_ka = $request->mainTitle_ka;
        $quizz_update->mainTitle_en = $request->mainTitle_en;
        $quizz_update->mainDescription_ka = $request->mainDescription_ka;
        $quizz_update->mainDescription_en = $request->mainDescription_en;
        $quizz_update->FeedbackOne_ka = $request->finalFeedbackOne_ka;
        $quizz_update->FeedbackTwo_ka = $request->finalFeedbackTwo_ka;
        $quizz_update->FeedbackThree_ka = $request->finalFeedbackThree_ka;
        $quizz_update->FeedbackFour_ka = $request->finalFeedbackThree_ka;
        $quizz_update->hidden = $request->hidden;



        if (!empty($filename)) {
            $quizz_update->upload = $filename;
        }
        if (!empty($filename1)) {
            $quizz_update->upload1 = $filename1;
        }
        if (!empty($filename2)) {
            $quizz_update->upload2 = $filename2;
        }
        if (!empty($filename3)) {
            $quizz_update->upload3 = $filename3;
        }
        if (!empty($filename4)) {
            $quizz_update->upload4 = $filename4;
        }

        $quizz_update->save();

        $questions = Question::where('quizz_id', $id)->get();
        Question::where('quizz_id', $id)->delete();

        $index = 0;
        foreach ($request->name_id as $k => $v) {
            $edit_id = $request->edit_id[$index];
            $question_ka = $request->question_ka[$index];
            $feedbackOne_ka = $request->feedbackOne_ka[$index];
            $feedbackTwo_ka = $request->feedbackTwo_ka[$index];
            $feedbackThree_ka = $request->feedbackThree_ka[$index];


            $answerOne_ka = $request->answerOne_ka[$index];
            //$answerOne_en = $request->answerOne_en[$index];
            $answerTwo_ka = $request->answerTwo_ka[$index];
            //$answerTwo_en = $request->answerTwo_en[$index];
            $answerThree_ka = $request->answerThree_ka[$index];
            // $answerThree_en = $request->answerThree_en[$index];

            $correct = $request->get('correct_' . $v);

            $filename = $this->getFileName($questions, $edit_id);
            if ($request->hasFile('uploadFeedback_' . $index)) {
                $myimage = $request->file('uploadFeedback_' . $index)->getClientOriginalName();
                $imgFile = Image::make($request->file('uploadFeedback_' . $index)->getRealPath());
                $imgFile->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $myimage));

                //$myimage = $request->upload->getClientOriginalName();
                //$request->upload->move(public_path('uploads'), $myimage);

                $filename = 'uploads/' . $myimage;
            }

            $question = Question::make();
            $question->quizz_id = $id;
            $question->question_ka = $question_ka;
            $question->answerOne_ka = $answerOne_ka;
            $question->answerTwo_ka = $answerTwo_ka;
            $question->answerThree_ka = $answerThree_ka;
            $question->feedbackOne_ka = $feedbackOne_ka;
            $question->feedbackTwo_ka = $feedbackTwo_ka;
            $question->feedbackThree_ka = $feedbackThree_ka;
            $question->correct = $correct;
            $question->upload = $filename;
            $question->save();

            $index++;
        }


        return redirect()->route('admin.quizz', [
            'quizz_update' => $quizz_update
        ]);
    }
    private function getFileName($questions, $edit_id)
    {
        if ((int)$edit_id === 0)
            return '';

        foreach ($questions as $question) {
            if ((int)$question->id === (int)$edit_id) {
                return $question->upload;
            }
        }
        return '';
    }
}
