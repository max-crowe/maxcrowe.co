<img height="1" width="1" style="display:none" src="{{ route('mark_submission_read', ['id' => $submission->id, 'token' => $submission->read_token]) }}">
<p>Forwarded on behalf of {{ $submission->email }}{{ $submission->name ? ' ('.$submission->name.')' : '' }}</p>

@foreach ($submission->lines() as $paragraph)
    <p>{{ $paragraph }}</p>
@endforeach
