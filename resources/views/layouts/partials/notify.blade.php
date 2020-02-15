<div class="notification-box with-shadow">
    <div class="notification-message">
        {{ $message }}
    </div>
    <div class="notification-close">
        {{ isset($icon) ? svg($icon) : svg('icon-mood-sad') }}
    </div>
</div>
