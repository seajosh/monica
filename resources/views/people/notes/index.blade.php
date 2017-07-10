<div class="col-xs-12 section-title">
  <img src="/img/people/notes.svg" class="icon-section">
  <h3>
    {{ trans('people.notes_title') }}

    <span>
      <a href="{{ route('people.notes.add', $contact->uuid) }}" class="btn">{{ trans('people.notes_add_one_more') }}</a>
    </span>
  </h3>
</div>

@if ($contact->notes->count() === 0)

  <div class="col-xs-12">
    <div class="section-blank">
      <a href="{{ route('people.notes.add', $contact->uuid) }}">{{ trans('people.notes_blank_link') }}</a> {{ trans('people.notes_blank_name', ['name' => $contact->getFirstName() ]) }}.
    </div>
  </div>

@else

  <div class="col-xs-12">

    <ul class="notes-list">
      @foreach ($contact->notes as $note)
        <li>
          {{ $note->getBody() }}
          <span class="note-date">
            {{ $note->getCreatedAt(Auth::user()->locale) }}
            <a href="{{ route('people.notes.edit', [$contact->uuid, $note]) }}">{{ trans('app.edit') }}</a>
            |
            <a href="{{ route('people.notes.delete', [$contact->uuid, $note]) }}" onclick="return confirm('{{ trans('people.notes_delete_confirmation') }}');">{{ trans('app.delete') }}</a>
          </span>
        </li>
      @endforeach
    </ul>

  </div>

@endif
