{{--
  -- Run Runners box
  -- Display infos of each convoys
  --
  -- @author Bastien Nicoud
  --}}

@foreach($subscriptions as $subscription)
    <div class="box">
        <div class="columns">
            <div class="column is-4">
                <p>
                    <strong>Runner</strong>
                </p>
                <p>
                    <figure class="image is-32x32">
                        <img src="{{ asset(Storage::url($subscription->user->profilePictures->first()->path)) }}">
                    </figure>
                    <a href="{{ route('users.show', ['user' => $subscription->user->id]) }}">
                        {{ $subscription->user->fullname }}
                    </a>
                </p>
            </div>

            <div class="column is-4">
                <p>
                    <strong>Type de véhicule</strong>
                </p>
                <p>
                    <a href="{{ route('carTypes.show', ['carType' => $subscription->carType->id]) }}">
                        {{ $subscription->carType->name }}
                    </a>
                </p>
            </div>

            <div class="column is-4">
                <p>
                    <strong>Véhicule</strong>
                </p>
            </div>
        </div>
    </div>
@endforeach
