@extends('layouts.skeleton')

@section('content')
  <div class="people-show activities">

    {{-- Breadcrumb --}}
    <div class="breadcrumb mb4">
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
                {{ trans('app.breadcrumb_add_activity') }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="mw7 center mb4 ph3 ph0-ns">

      <h2 class="f3 fw3 measure tc mb4">{{ trans('people.activities_add_title', ['name' => $contact->getFirstName()]) }}</h2>

      @include('people.activities.form', [
        'method' => 'POST',
        'action' => route('people.activities.store', $contact)
      ])
    </div>

  </div>
@endsection
