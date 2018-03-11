<ul class="list-group">
@foreach($messages as $m)
        <li class="list-group-item">
            <span>Type: {{$m->type}}</span>
            <span>Version: {{$m->version}}</span>
            <span>Last Updated On: {{ date('m-d-Y', strtotime($m->updated_at)) }}</span>
            <span>Message: {{ $m->content }}</span>
            <span><button>Change Message</button></span>
        </li>
@endforeach
</ul>