<div class="row">
    <section class="col">
        <h2>Inbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($inbox as $card)
                    @isset($card->a_id)
                        @component('components.question', ['card' => $card])
                            @if (!request()->is('*home'))
                                @component('components.answer', ['card' => $card])
                                @endcomponent
                            @else
                            <header><small>{{$card->a_updated_at}}</small></header>
                            <article>
                                <form method="POST" action="{{url('home/answer/'.$card->q_id)}}">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="body" style="width: 100%;">{{$card->a_body}}</textarea>
                                    <p><button class="btn btn-primary" type="submit">Answer</button></p>
                                </form>
                                @error('body')
                                    <div class="alert alert-danger">
                                        Answer is required.
                                    </div>
                                @enderror
                                @endif
                            </article>
                        @endcomponent
                    @endisset
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($inbox as $card)
                    @empty($card->a_id)
                        @component('components.question', ['card' => $card])
                        <article>
                            @if (request()->is('*home'))
                            <header><small>{{$card->a_updated_at}}</small></header>
                            <form method="POST" action="{{url('home/answer/'.$card->q_id)}}">
                                @csrf
                                @method('PUT')
                                <textarea name="body" style="width: 100%;">{{$card->a_body}}</textarea>
                                <p><button class="btn btn-primary" type="submit">Answer</button></p>
                            </form>
                            @endif
                        </article>
                        @endcomponent
                    @endempty
                @endforeach
            </section>
        </div>
    </section>
    <section class="col">
        <h2>Outbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($outbox as $card)
                    @isset($card->a_id)
                        @component('components.question', ['card' => $card])
                            @component('components.answer', ['card' => $card])
                            @endcomponent
                        @endcomponent
                    @endisset
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($outbox as $card)
                    @empty($card->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endempty
                @endforeach
            </section>
        </div>
    </section>
</div>
