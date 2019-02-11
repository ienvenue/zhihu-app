<li class="notifications  {{ $notification->unread()? 'unread' : ' ' }}">
    <a href="{{$notification->unread() ? '/notifications/'.$notification->id.'?redirect_url=/inbox/'.$notification->data['dialog'] : '/inbox/'.$notification->data['dialog']}}">
        {{ $notification->data['name'] }} send new messages.
    </a>
</li>