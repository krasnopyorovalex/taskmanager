@if (session('message'))
    <div class="message-info with-icon rounded-block with-shadow">
        {{ svg('icon-information') }}
        {{ session('message') }}
    </div>
@endif
