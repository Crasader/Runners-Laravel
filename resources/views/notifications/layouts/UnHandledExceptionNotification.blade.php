{{--
  -- App\Notifications\UnHandledExceptionNotification layout for app display (in notification crud)
  --
  -- @author Bastien Nicoud
  --}}

<div class="columns">
    <div class="column is-5">
        <h2 class="title is-3">Infos</h2>
    </div>
    <div class="column is-7">
        <h2 class="title is-3">Données</h2>
    </div>
</div>

<div class="columns">
    <div class="column is-5">
        <div class="content box">
            <p>
                Cette erreur a été loggée dans le fichier de log de l'application,
                vous pouvez retrouver la stack-trace en recherchant l'heure de l'erreur dans le fichier de log.
            </p>
            <p>
                <strong>Exception :</strong>
                <span class="tag is-light">{{ $notification->data['exception_class'] }}</span>
            </p>
            <p>
                <strong>Http code :</strong>
                <span class="tag is-light">{{ $notification->data['exception_http_code'] }}</span>
            </p>
            <p>
                <strong>Time :</strong>
                <span class="tag is-light">{{ $notification->data['time'] }}</span>
            </p>
            <p>
                <strong>Page :</strong>
                <span class="tag is-light">{{ $notification->data['current_page'] }}</span>
            </p>
            <p>
                <strong>Previous page :</strong>
                <span class="tag is-light">{{ $notification->data['previous_page'] }}</span>
            </p>
            <p>
                <strong>Utilisateur :</strong>
                <ul>
                    <li>{{ App\User::find($notification->data['user_id'])->fullname }}</li>
                </ul>
            </p>
        </div>
    </div>
    <div class="column is-7">
        <div class="content box">
            <p>
                <strong>Message :</strong>
                <span class="tag is-light">{{ $notification->data['exception_message'] }}</span>
            </p>
            <p>
                <strong>File :</strong>
                <span class="tag is-light">{{ $notification->data['exception_file'] }}</span>
            </p>
            <p>
                <strong>Line :</strong>
                <span class="tag is-light">{{ $notification->data['exception_line'] }}</span>
            </p>
            <p>
                <strong>Route :</strong>
                <ul>
                    @foreach($notification->data['route'] as $key => $value)
                        <li><strong>{{ $key }} : </strong><pre>{{ var_dump($value) }}</pre></li>
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
</div>