

<li class="notifications {{ $notification->unread() ? 'unread' : ' ' }}">
    <a href="{{ $notification->data['name'] }}">
{{ $notification->data['name'] }}
</a> follow you!
</li>