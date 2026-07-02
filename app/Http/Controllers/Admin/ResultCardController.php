<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ResultCard;
use App\Services\ResultCalculationService;
use Illuminate\Http\Request;

class ResultCardController extends Controller
{
    public function __construct(
        protected ResultCalculationService $results
    ) {}

    public function index(Request $request)
    {
        $exams = Exam::with('academicYear')->orderByDesc('Start_Date')->get();
        $examId = $request->integer('exam_id') ?: $exams->first()?->Exam_ID;

        $resultCards = ResultCard::with(['student.section.schoolClass', 'exam'])
            ->when($examId, fn ($q) => $q->where('Exam_ID', $examId))
            ->orderBy('Class_Rank')
            ->paginate(20)
            ->withQueryString();

        return view('admin.results.index', compact('resultCards', 'exams', 'examId'));
    }

    public function generate(Exam $exam)
    {
        $count = $this->results->generateForExam($exam);

        return back()->with('success', "Generated/updated {$count} result cards.");
    }

    public function publish(Exam $exam)
    {
        ResultCard::where('Exam_ID', $exam->Exam_ID)->update(['Is_Published' => true]);

        return back()->with('success', 'Result cards published for students.');
    }

    public function unpublish(Exam $exam)
    {
        ResultCard::where('Exam_ID', $exam->Exam_ID)->update(['Is_Published' => false]);

        return back()->with('success', 'Result cards unpublished.');
    }
}
