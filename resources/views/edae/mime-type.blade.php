@if (Str::is("image/*", $media->mime_type))
    <img class="adaptive-300-200" src="{{ $media->getUrl() }}" alt="{{ $media->name }}">
@elseif (Str::is("video/*", $media->mime_type))
    <video class="adaptive-300-200" controls="controls" poster="">
        <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }};">
        Тег video не поддерживается вашим браузером.
        <a href="{{ $media->getUrl() }}">Скачать видео</a>.
   </video>
@elseif (Str::is("document/*", $media->mime_type))
    <a href="{{ $media->getUrl() }}">Файл - {{ $media->name }}</a>
@else
@endif
