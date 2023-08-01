@guest
    I am guest
@endguest

@auth

    <div class="row">
        <div class="col-4">
            <h4>Profile</h4>
            <span>This information will be displayed publicly so be careful what you share.</span>
        </div>
        <div class="col-8">
            @include('pixii::content.user.update-personal')
        </div>
    </div>

@endauth
