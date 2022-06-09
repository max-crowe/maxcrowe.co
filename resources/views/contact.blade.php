<x-layout>
    <p class="centered">Drop me a line here. You can also reach me via <a href="https://www.linkedin.com/in/max-crowe-bba8b5b7/">LinkedIn</a> if that's your jam.</p>
    @if ($errors->any())
    <p class="form-error">Please correct the error below.</p>
    @endif
    <form name="contact" method="post" action="{{ route('contact') }}">
        @csrf
        <div class="field">
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
            <label for="email">Your email address:</label>
            <input id="email" name="email" type="email" class="@error('email') invalid @enderror" value="{{ old('email') }}">
        </div>
        <div class="field">
            <label for="name">Your name (optional):</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}">
        </div>
        <div class="field">
            @error('message')
                <p class="form-error">{{ $message }}</p>
            @enderror
            <label for="message">Message:<span id="character-counter">Remaining characters: <span id="character-count">{{ config('mail.message_max_length') }}</span></span></label>
            <textarea id="message" name="message" maxlength="{{ config('mail.message_max_length') }}">{{ old('message') }}</textarea>
        </div>
        <div class="field">
            @error('human_proof')
                <p class="form-error">Sorry, try again.</p>
            @enderror
            <label for="human_proof">So I know you're a human, what city do I live in?</label>
            <input id="human_proof" name="human_proof" value="{{ old('human_proof') }}">
        </div>
        <div class="field">
            <input class="button" name="submit" type="submit" value="Send message">
        </div>
    </form>
</x-layout>
