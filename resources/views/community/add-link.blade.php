@if (Auth::check())
    <div class="col-md-4">
        <h3>Contribute a Link</h3>

        <div class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="/community">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('channel_id') ? 'has-error' : '' }}">
                        <label for="Channel">Channel:</label>

                        <select class="form-control" name="channel_id">
                            <option selected disabled>Pick a Channel...</option>

                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                    {{ $channel->title }}
                                </option>
                            @endforeach
                        </select>

                        {!! $errors->first('channel_id', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">Title:</label>

                        <input type="text"
                               class="form-control"
                               id="title"
                               name="title"
                               placeholder="What is the title of your article?"
                               value="{{ old('title') }}"
                               required>

                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                        <label for="link">Link:</label>

                        <input type="text"
                               class="form-control"
                               id="link"
                               name="link"
                               placeholder="What is the URL?"
                               value="{{ old('link') }}"
                               required>

                        {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Contribute Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
    <div class="col-md-4">Please sign in.</div>
@endif