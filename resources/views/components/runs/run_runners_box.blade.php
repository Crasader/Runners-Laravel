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
                    @if($subscription->user()->exists())
                        <a href="{{ route('users.show', ['user' => $subscription->user->id]) }}">
                            {{ $subscription->user->fullname }}
                        </a>
                    @else
                        Pas de chauffeur selectionné
                    @endif
                </th>
                <td>
                    @if($subscription->carType()->exists())
                        <a href="{{ route('carTypes.show', ['carType' => $subscription->carType->id]) }}">
                            {{ $subscription->carType->name }}
                        </a>
                    @else
                        Pas de type de véhicule spécifié
                    @endif
                </td>
                <td>
                    @if($subscription->car()->exists())
                        <a href="{{ route('cars.show', ['car' => $subscription->car->id]) }}">
                            {{ $subscription->car->name }}
                        </a>
                    @else
                        Pas de véhicule specifié
                    @endif
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
