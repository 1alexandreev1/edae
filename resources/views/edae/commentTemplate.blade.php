<div class="card my-2">
    <div class="card-body">
        @guest
            <div class="text-center" >
                <p>Eсли хотите оставить комментарий, требуется <a class="btn btn-outline-primary" href="{{ route('login') }}">Войти</a> или <a class="btn btn-outline-primary" href="{{ route('register') }}">Зарегестрироваться</a></p>
            </div>
        @else
            <div class="mb-2" id="comments" style="max-height: 600px; overflow: auto;">
                @if ($comments->isEmpty())
                    <div class="text-center">
                        <i class="fas fa-comments"></i> Комментариев пока нет, вы можете быть первым.
                    </div>
                @else
                    @include('edae.comments')
                @endif
            </div>
            <form action="{{ $url }}" method="post" id="comment_form">
                <textarea class="form-control" name="text" id="comment"></textarea>
                @csrf
                <input hidden type="number" value="" name="reply_to" id="reply_to">
                <input hidden type="number" value="" name="parrent_id" id="parrent_id">
                <input hidden type="text" value="@if ($comments->isNotEmpty()){{ $comments->last()->created_at }}@else{{ now() }}@endif"
                        name="lastCommentDate" id="lastCommentDate">
                <div class="text-right">
                    <button class="btn btn-outline-primary mt-1" type="button" onclick="sendFormFunction(comment_form, (data) => {
                        if (data.status) {
                            $(comment_form).trigger('reset')
                            $(comments).append(data.commentsHtml)
                            $(lastCommentDate).val(data.lastCommentDate)
                        }
                    })">Отправить</button>
                </div>
            </form>
        @endguest
    </div>
    <script>
        if (comments) {
            comments.scrollTop = comments.scrollHeight;
        }
    </script>
</div>
