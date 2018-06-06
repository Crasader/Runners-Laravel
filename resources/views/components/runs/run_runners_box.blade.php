{{--
  -- Run Runners box
  -- Display infos of each convoys
  --
  -- @author Bastien Nicoud
  --}}

<table class="table is-striped is-hoverable is-fullwidth">
    <thead>
        <tr>
            <th>Chauffeur</th>
            <th>Type de véhicule</th>
            <th>Véhicule</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subscriptions as $subscription)
            <tr>
                <th>
                    <a href="{{ route('users.show', ['user' => $subscription->user->id]) }}">
                        {{ $subscription->user->fullname }}
                    </a>
                </th>
                <td>
                    <a href="{{ route('carTypes.show', ['carType' => $subscription->carType->id]) }}">
                        {{ $subscription->carType->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('cars.show', ['car' => $subscription->car->id]) }}">
                        {{ $subscription->car->name }}
                    </a>
                </td>
                <td>
                    {{-- Status tag (see related component) --}}
                    @component('components/status_tag', ['status' => $subscription->status])
                    @endcomponent
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
