@if(setting('fp_enable_testimony', true))
    <div class="hp-feedback my-5">
        <div class="container">
            <h3 class="hp-feedback-title font-weight-normal text-center">{{ setting('fp_testimony_title') }}</h3>
            <div class="row my-5">
                @for($i=1; $i<=3; $i++)
                    @if(setting('fp_testimony_'.$i))
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <blockquote class="hp-feedback-quote">
                                        {{ setting('fp_testimony_'.$i) }}
                                    </blockquote>
                                    <div class="hp-feedback-name">&mdash; {{ setting('fp_testimony_'.$i.'_name') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
@endif
