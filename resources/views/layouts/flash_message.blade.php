{{--
  -- Flash message
  -- Display the session flash messages
  --
  -- @author Bastien Nicoud
  --}}

<div class="container">
    <div class="columns">
        <div class="column is-12">
            {{-- Display success messages --}}
            @if (session('success'))
                <article class="message is-primary">
                    <div class="message-body">
                        {{ session('success') }}
                    </div>
                </article>
            @endif
            {{-- Display error messages --}}
            @if (session('error'))
                <article class="message is-danger">
                    <div class="message-body">
                        {{ session('error') }}
                    </div>
                </article>
            @endif
            {{-- Display warning messages --}}
            @if (session('warning'))
                <article class="message is-danger">
                    <div class="message-body">
                        {{ session('warning') }}
                    </div>
                </article>
            @endif
            {{-- Display information messages --}}
            @if (session('info'))
                <article class="message is-info">
                    <div class="message-body">
                        {{ session('info') }}
                    </div>
                </article>
            @endif
        </div>
    </div>
</div>