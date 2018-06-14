{{--
  -- Run Runners box
  -- Display infos of each convoys
  --
  -- @author Bastien Nicoud
  --}}

<div class="box content">
    <strong>{{ $subscriptions->count() }}</strong> Runners pour ce run :
    <ul>
        @foreach($subscriptions as $subscription)
            <li>
                @if($subscription->user()->exists())
                    <a href="{{ route('users.show', ['user' => $subscription->user->id]) }}">
                        {{ $subscription->user->fullname }},
                    </a>
                @else
                    Chauffeur à définir,
                @endif
                @if($subscription->car()->exists())
                    avec le véhicule
                    <a href="{{ route('cars.show', ['car' => $subscription->car->id]) }}">
                        {{ $subscription->car->name }}
                    </a>
                @else
                    avec un véhicule de type
                    @if($subscription->carType()->exists())
                        <a href="{{ route('carTypes.show', ['carType' => $subscription->carType->id]) }}">
                            {{ $subscription->carType->name }}
                        </a>
                        , pas encore défini présisément.
                    @else
                        pas encore défini.
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
</div>
