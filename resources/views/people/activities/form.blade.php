<form method="POST" action="{{ $action }}">
    {{ method_field($method) }}
    {{ csrf_field() }}

    @include('partials.errors')

    {{-- Past or present --}}
    <div class="mb3">
      <label class="dib mr2">
          <input type="radio" class="" name="in_debt" id="youowe" value="yes" @if(old('in_debt') !== 'no' || $debt->in_debt !== 'no') checked @endif>
          Report an activity that happened
      </label>

      <label class="dib">
          <input type="radio" class="input" name="in_debt" id="theyowe" value="no">
          Schedule an upcoming activity
      </label>
    </div>

    {{-- Summary --}}
    <div class="mb3">
      <label for="summary">Describe what this activity is about</label>
      <input type="text" id="summary" class="db input-reset pa2 w-100" name="summary" autofocus required maxlength="254" value="{{ old('summary') ?? $activity->summary }}" placeholder="Go to the theater and have a lot of fun">
    </div>

    <div class="cf mb3">
      <label class="db">Date of the activity</label>
      <select name="year">
        @for ($i = 0 ; $i < 10 ; $i++)
          <option value="">{{ \Carbon\Carbon::now(Auth::user()->timezone)->subYears($i)->year }}</option>
        @endfor
      </select>
      <select name="month">
        @for ($i = 0 ; $i < 10 ; $i++)
          <option value="">{{ \Carbon\Carbon::now(Auth::user()->timezone)->subYears($i)->year }}</option>
        @endfor
      </select>
      <select name="year">
        @for ($i = 1 ; $i < 32 ; $i++)
          <option value="">{{ $i }}</option>
        @endfor
      </select>
    </div>

    {{-- Date --}}
    <div class="form-group{{ $errors->has('date_it_happened') ? ' has-error' : '' }}">
      <label for="date_it_happened">{{ trans('people.activities_add_date_occured') }}</label>
      <input type="date" id="date_it_happened" name="date_it_happened" class="form-control"
           value="{{ old('date_it_happened') ?? $activity->date_it_happened->format('Y-m-d') ?? \Carbon\Carbon::now(Auth::user()->timezone)->format('Y-m-d') }}"
           min="{{ \Carbon\Carbon::now(Auth::user()->timezone)->subYears(10)->format('Y-m-d') }}"
           max="{{ \Carbon\Carbon::now(Auth::user()->timezone)->format('Y-m-d') }}"
        >
    </div>

    {{-- Build the Activity types dropdown --}}
    <div class="form-group{{ $errors->has('activity_type_id') ? ' has-error' : '' }}">
        <label for="activity_type_id">{{ trans('people.activities_add_pick_activity') }}</label>
        <select id="activity_type_id" name="activity_type_id" class="form-control" required>

            {{-- Blank option --}}
            <option value="0" selected>
                -
            </option>

            {{-- Predefined options --}}
            @foreach (App\ActivityTypeGroup::all() as $activityTypeGroup)
                <optgroup label="{{ trans('people.activity_type_group_'.$activityTypeGroup->key) }}">
                    @foreach (App\ActivityType::where('activity_type_group_id', $activityTypeGroup->id)->get() as $activityType)
                        <option value="{{ $activityType->id }}">
                            {{ trans('people.activity_type_'.$activityType->key) }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>

    <div class="mb4">
      <label for="description">{{ trans('people.activities_add_optional_comment') }}</label>
      <textarea class="w-100" id="description" name="description" rows="3">{{ old('description') ?? $activity->description }}</textarea>
    </div>

    <div class="flex items-center justify-center">
      <div class="inline-flex items-center w-100 mr4">
        <button type="submit" class="w-100 btn btn-primary">{{ trans('people.activities_add_cta') }}</button>
      </div>
      <div class="inline-flex items-center w-100">
        <a href="{{ route('people.show', $contact) }}" class="w-100 btn btn-secondary">{{ trans('app.cancel') }}</a>
      </div>
    </div>
</form>
