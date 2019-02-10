{{--<li class="notifications  {{ $notification->unread ? 'unread' : ' ' }}">--}}
<li class="notifications">
    <a href="/inbox/{{ $notification->data['dialog'] }}">
        {{ $notification->data['name'] }} send new messages.
    </a>
</li>