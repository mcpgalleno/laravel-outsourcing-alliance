
@if(session()->has('notification-status'))
    @if(session()->get('notification-status') === 'success') 
        <div class="custom-toast success-toast">
            <span>
                {{session()->get('notification-msg')}}
            </span>
        </div>
     @endif
    @if(session()->get('notification-status') === 'failed') 
        <div class="custom-toast failed-toast">
            <span>
                {{session()->get('notification-msg')}}
            </span>
        </div>
     @endif
@endif

<script>
    $(document).ready(function() {
        $('.custom-toast').css('transform', 'translate(-50%, 600%)')
        setTimeout(function() { 
            $('.custom-toast').css('transition', 'opacity 2s ease-in-out')
            $('.custom-toast').css('opacity', 0)
        }, 1000);
    });
</script>