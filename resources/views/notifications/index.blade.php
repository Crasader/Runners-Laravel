{{--
  -- Notifications index
  -- Show the notifications of the authenticated user
  -- (Actually, only root can acess this model)
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Mes notifications</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Notifications</h1>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Lue</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Lue</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>
                                    @datetag(['date' => $notification->created_at])
                                        Le
                                    @enddatetag
                                </td>
                                <th>{{ $notification->type }}</th>
                                <td>{{ $notification->read_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $notifications->links() }}

    </div>
</div>

@endsection