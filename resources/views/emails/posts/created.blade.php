@component('mail::message')
# New Post Created

**Title:** {{ $post->title }}

**Content:**

{{ $post->content }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
