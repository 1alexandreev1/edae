<div class="row justify-content-between">
    <div class="col-auto">
        <i class="fas fa-user"></i>
        <a href="{{ route('users.show', ($model->user->id) ?? 0) }}"> {{ ($model->user->login) ?? __('general.user.not_found') }}</a>
        | <i class="fas fa-eye"></i> {{ $model->views ?? 0 }}
        | <i class="fas fa-tags"></i> {{ $model->tags->take(3)->implode('name', ', ') }}
    </div>
    <div class="col-auto">
        <i class="fas fa-calendar"></i> {{ $model->publish ?? '' }} |
        @if (Route::is("{$route}index") || Route::is("home"))
            <span class="@if (!Auth::guest() && $model->like->user_id == Auth::id() && $model->like->like) text-danger @endif">
                <i class="fas fa-thumbs-up"></i> {{ $model->likes_count }}
            </span>
            <span class="@if (!Auth::guest() && $model->like->user_id == Auth::id() && !$model->like->like) text-danger @endif">
                <i class="fas fa-thumbs-down"></i> {{ $model->dislikes_count }}
            </span>
        @else
            @auth
                {{-- ставим лайки --}}
                <button id="like" class="btn btn-sm @if (!Auth::guest() && $model->like->user_id == Auth::id() && $model->like->like) text-danger @endif"
                    type="button"
                    onclick="sendGet('{{ route($route.'estimation', [$model->id, 'like']) }}', (data) => {
                        if (data.status) {
                            $(like).addClass('text-danger')
                            $(dislike).removeClass('text-danger')
                            $(likes_count).html(data.likes_count)
                            $(dislikes_count).html(data.dislikes_count)
                        }
                    })"
                    ><i class="fas fa-thumbs-up"></i> <span id="likes_count">{{ $model->likes_count }}</span></button>
                <button id="dislike" class="btn btn-sm @if (!Auth::guest() && $model->like->user_id == Auth::id() && !$model->like->like) text-danger @endif"
                    type="button"
                    onclick="sendGet('{{ route($route.'estimation', [$model->id, 'dislike']) }}', (data) => {
                        if (data.status) {
                            $(dislike).addClass('text-danger')
                            $(like).removeClass('text-danger')
                            $(likes_count).html(data.likes_count)
                            $(dislikes_count).html(data.dislikes_count)
                        }
                    })"
                    ><i class="fas fa-thumbs-down"></i> <span id="dislikes_count">{{ $model->dislikes_count }}</span></button>
            @else
                {{-- отображение лайков если не авторизован --}}
                <span class="@if (!Auth::guest() && $model->like->user_id == Auth::id() && $model->like->like) text-danger @endif">
                    <i class="fas fa-thumbs-up"></i> {{ $model->likes_count }}
                </span>
                <span class="@if (!Auth::guest() && $model->like->user_id == Auth::id() && !$model->like->like) text-danger @endif">
                    <i class="fas fa-thumbs-down"></i> {{ $model->dislikes_count }}
                </span>
            @endauth
        @endif
    </div>
</div>
