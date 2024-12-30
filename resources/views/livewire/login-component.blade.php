<div class="login-container">
    <div class="login-header">
        <img src="{{asset('assets/login.png')}}" alt="Library Logo">
        <h2>Library Login</h2>
    </div>
    <form>
        <div class="form-group">
            <input type="text" wire:model="email" class="form-control" id="email" placeholder="Email Address">
            @error('email')   
                <div class="alert alert-danger" role="alert">
                     {{$message}}
                </div> 
            @enderror
        </div>
        <div class="form-group">
            <input type="password" wire:model="password" class="form-control" id="password" placeholder="Password">
            @error('password')
                <div class="alert alert-danger" role="alert">
                     {{$message}}
                </div> 
            @enderror
        </div>
        <button type="button" wire:click="proses" class="btn btn-primary btn-login">Login</button>
    </form>
</div>