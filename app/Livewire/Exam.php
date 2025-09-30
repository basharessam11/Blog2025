<?php

namespace App\Livewire;

use App\Models\Answers;
use App\Models\Questions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Exam extends Component
{
    public $exam_id;
    public $questions;
    public $index = 0;
    public $question;
    public $options = [];
    public $savedAnswer;
    public $timeLeft;

    public function mount($exam_id)
    {
        // تعيين الـ exam_id
        $this->exam_id = $exam_id;

        // تحميل الأسئلة
        $this->questions = Questions::where('exam_id', $exam_id)->get();
        $this->loadQuestion();

        // حساب الوقت المتبقي
        $endTime = session()->get('exam_end_time', now()->addMinutes(10));
        $this->timeLeft = now()->diffInSeconds($endTime, false);

        // تحديث وقت الانتهاء إذا كان قد انتهى
        if ($this->timeLeft <= 0) {
            $this->finish();  // إذا انتهى الوقت، ننهي الاختبار
        }

        session()->put('exam_end_time', now()->addSeconds($this->timeLeft));
    }

    // تحميل السؤال الحالي مع الخيارات والإجابة المحفوظة
    public function loadQuestion()
    {
        if ($this->index < 0 || $this->index >= $this->questions->count()) {
            $this->index = 0;
        }

        $this->question = $this->questions[$this->index];
        $this->options = $this->question->options()->get();
        $this->savedAnswer = Answers::where('customer_id', Auth::id())
            ->where('question_id', $this->question->id)
            ->first();
    }

    // الانتقال للسؤال التالي
    public function next()
    {
        if ($this->index < $this->questions->count() - 1) {
            $this->index++;
            $this->loadQuestion();
        }
    }

    // العودة للسؤال السابق
    public function previous()
    {
        if ($this->index > 0) {
            $this->index--;
            $this->loadQuestion();
        }
    }

    // إنهاء الاختبار
    public function finish()
    {
        session()->forget('exam_end_time');
        // هنا يمكن حفظ الأجوبة أو إعادة توجيه المستخدم
        return redirect()->route('exam1.index')->with('success', 'تم إنهاء الاختبار بنجاح');
    }

    // الدالة التي تعرض الكومبوننت
    public function render()
    {
        return view('livewire.exam');
    }
}
