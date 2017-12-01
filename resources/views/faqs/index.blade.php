@extends('layouts.front-end')

@section('content')
    @if (count($faqs) > 0) {{-- faq points are found. --}}
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($faqs as $faq) {{-- Loop through the faq points --}}
                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <i class="fa fa-question-circle"></i>
                            
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                {{ $faq->question }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $faq->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $faq->id }}e">
                        <div class="panel-body">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @endforeach {{-- END loop --}}
        </div>
    @else {{-- No faq points are found --}}
        <div role="alert" class="tw-bg-blue-lightest tw-border tw-border-blue-light tw-text-blue-dark tw-px-4 tw-py-3 tw-rounded tw-relative">
            <strong class="tw-font-bold">Geen FAQ puntjes gevonden.</strong>
            <span class="tw-block tw-sm:inline">Momenteel zijn er geen faq punten gevonden. Kom later nog eens terug.</span>
        </div>
    @endif
@endsection