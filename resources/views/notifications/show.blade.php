{{--
  -- Notifications show
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('notifications.index') }}">Mes notifications</a></li>
<li class="is-active"><a href="#" aria-current="page">
    @datetag(['date' => $notification->created_at])
        Le
    @enddatetag
    &nbsp;
    @component('components/notifications/notification_types', ['type' => $notification->type])
    @endcomponent
</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    Notification
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <a href="{{ route('notifications.read', ['id' => $notification->id]) }}" class="button is-info">
                            Marquer comme lue
                        </a>
                    </p>
                    <p class="control">
                        <form id="delete-notification-form"
                            action="{{ route('notifications.destroy', ['id' => $notification->id]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <button onclick="event.preventDefault();
                            document.getElementById('delete-notification-form').submit();"
                            class="button is-danger">
                            Supprimer la notification
                        </button>
                    </p>
                </div>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                @component('components/notifications/render_notification', ['notification' => $notification])
                @endcomponent
            </div>
        </div>

    </div>
</div>

@endsection