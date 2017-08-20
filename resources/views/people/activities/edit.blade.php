@extends('layouts.skeleton')

@section('content')
  <div class="people-show activities">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
      <div class="{{ Auth::user()->getFluidLayout() }}">
        <div class="row">
          <div class="col-xs-12">
            <ul class="horizontal">
              <li>
                <a href="/dashboard">{{ trans('app.breadcrumb_dashboard') }}</a>
              </li>
              <li>
                <a href="/people">{{ trans('app.breadcrumb_list_contacts') }}</a>
              </li>
              <li>
                <a href="/people/{{ $contact->id }}">{{ $contact->getCompleteName(auth()->user()->name_order) }}</a>
              </li>
              <li>
                {{ trans('app.breadcrumb_edit_activity') }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="mw7 center mb4 ph3 ph0-ns">

      @include('people.activities.form', [
        'method' => 'PUT',
        'action' => route('people.activities.update', [$contact, $activity])
      ])

    </div>

  </div>
@endsection
