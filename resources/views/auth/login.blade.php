<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('signin/css/global.css') }}">
    <link rel="stylesheet" href="{{asset('signin/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('signin/css/responsive.css')}}">
    <title>Login!</title>
  </head>
  <body>
      <div class="container-fluid">
          <div class="row float-right">
              <div class="col-sm-offset-5 col-sm-2">
                <button id="change-theme-btn">Dark</button>
              </div>
          </div>
      </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-wrapper">
                    <div class="login-heading">
                        <h1 class="text-center">Login to your account</h1>
                    </div>
                    
                    <main>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="field">
                                <input type="email" name="email" class="input @error('email') is-invalid @enderror" id="email" placeholder=" " value="{{old('email')}}" required autocomplete="email" autofocus>
                                <label for="email" class="label">Email</label>
                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="field">
                            <i class="far fa-eye" id="eye"></i>
                            <input type="password" name="password" class="input  @error('password') is-invalid @enderror" id="pwd" placeholder=" " required autocomplete="current-password">
                            <label for="password" class="label">Password</label>
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <input type="submit" class="loginBtn mt-3" type="button "name="login" value="Login" class="input"><br>
                           
                       
                        </form>
                    </main>
                </div> 
            </div>
        </div>
    </div>
    
         
      
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{ asset('signin/js/app.js') }}"></script>
  </body>
</html>


