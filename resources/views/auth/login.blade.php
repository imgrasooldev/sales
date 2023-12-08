@include('includes.siteHeader')
<section class="loginWrap">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container">
        <div class="loginscreen">
            <div class="row">
                <div class="col-md-6 pad-zero">
                    <div class="loginImg">
                        <img src="assets/images/loginimg.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 pad-zero">
                    <div class="loginform">
                        <div class="loginlogo">
                            <img src="assets/images/logo.png" alt="">
                        </div>
                        <form method="POST" action="{{ route('login') }}" >
                            @csrf
                            <div class="loginfield">
                                <label>Username</label>
                                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" type="text" placeholder="Username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="loginfield">
                                <label>Password</label>
                                <input required autocomplete="current-password"  id="password" name="password" type="password" placeholder="******">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <button type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.scripts')

</body>

</html>
