{{--
  -- Show group details
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('groups.index') }}">Groups</a></li>
<li class="is-active"><a href="#" aria-current="page">Manager</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/users/edit.js') }}"></script>
@endpush
  
@section('content')

@endsection