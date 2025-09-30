<div>
    <h4 class="mb-4">السؤال {{ $index + 1 }} من {{ $questions->count() }}</h4>
    <h5>{{ $question->question_text }}</h5>

    @if ($question->type == 1)
        @foreach ($options as $option)
            <div class="form-check my-2">
                <input class="form-check-input" type="radio" wire:model="savedAnswer.answer" value="{{ $option->id }}"
                    id="option{{ $option->id }}">
                <label class="form-check-label" for="option{{ $option->id }}">
                    {{ $option->name }}
                </label>
            </div>
        @endforeach
    @else
        <textarea class="form-control" wire:model.lazy="savedAnswer.answer"></textarea>
    @endif

    <div class="d-flex justify-content-between mt-4">
        @if ($index > 0)
            <button class="btn btn-secondary" wire:click="previous">السابق</button>
        @endif

        @if ($index < $questions->count() - 1)
            <button class="btn btn-primary" wire:click="next">التالي</button>
        @else
            <button class="btn btn-success" wire:click="finish">إنهاء الاختبار</button>
        @endif
    </div>

    <div class="mt-3 text-muted">الوقت المتبقي: {{ gmdate('i:s', $timeLeft) }}</div>
</div>
