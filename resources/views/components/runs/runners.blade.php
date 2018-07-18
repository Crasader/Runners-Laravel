{{--
  -- Run Runners box
  -- Display infos of each convoys
  --
  -- @author Xavier Carrel
  --}}
<ul>
@foreach($subscriptions as $subscription)
    <div>
        @if($subscription->car()->exists())
            {{ $subscription->car->name }}
        @else
            @if($subscription->carType()->exists())
                {{ $subscription->carType->name }}
            @else
                <span>?</span>
            @endif
        @endif
        <span>/</span>
        @if($subscription->user()->exists())
            {{ $subscription->user->name }}
        @else
                <span>?</span>
        @endif
    </div>
@endforeach
</ul>