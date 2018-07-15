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
                <h1 class="title is-2">Mes notifications</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <a href="{{ route('notifications.read') }}" class="button is-info">
                            Tout marquer comme lu
                        </a>
                    </p>
                </div>
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
                    <tbody>
                        @forelse ($notifications as $notification)
                            <tr onclick="window.location.href = '{{ route('notifications.show', ['notification' => $notification->id]) }}'">
                                <td>
                                    @datetag(['date' => $notification->created_at])
                                        Le
                                    @enddatetag
                                </td>
                                <th>
                                    @component('components/notifications/notification_types', ['type' => $notification->type])
                                    @endcomponent
                                </th>
                                <td>
                                    @datetag(['date' => $notification->read_at])
                                        Le
                                    @enddatetag
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="tag is-warning is-medium">
                                        <strong>Aucune notification<strong>
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $notifications->links() }}

    </div>
</div>

@endsection