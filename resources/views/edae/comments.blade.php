@foreach ($comments as $item)
    <div class="post border m-1 p-1" id="comment_id_{{ $item->id }}">
        <div class="user-block">
            <img class="img-circle img-bordered-sm" style="max-width: 35px; max-height: 35px" src="{{ $item->user->avatar }}" alt="user image">
            <span class="username">
                <a href="{{ route('users.show', $item->user->id) }}">{{ $item->user->login }}</a>
            </span>
            <span class="description">Дата публикации: {{ $item->created_at }}</span>
        </div>
        <p>
            {{ $item->text }}
        </p>
        {{-- <hr /> --}}
    </div>
@endforeach
