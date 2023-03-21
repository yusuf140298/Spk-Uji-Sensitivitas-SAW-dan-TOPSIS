<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <title>Login</title>
        <style>
            *{
                background-color:;
            }
            body .card{
                position: fixed;
                width: 500px;
                height: auto;
                margin-left: 525px;
                margin-top: 150px;
            }
            body .card .isicard h5{
                text-align: center;
                margin-bottom: 40px;
            }
            body .card .isicard button{
                width: 425px;
            }
        </style>
    </head>
		@if (session()->has('succes'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<center>{{ session('succes') }}</center>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@elseif (session()->has('fail'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<center>{{ session('fail') }}</center>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card-body isicard">
                <h5 class="card-title">Login</h5>
                <form action="{{ url ('/Login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="m-2">NIP</label>
                        <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukan NIP" required>
                        @error('nip')
                            <div class="text-danger">
                                {{ $message }}  
                            </div>
                        @enderror
                    </div>
					<br>
                    <div class="form-group">
                        <label for="password" class="m-2">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" required>
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @if(session()->get('error'))
                        <div class="invalid-feedback">{{ session('error') }}</div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-2">Login</button>
                </form>
            </div>
        </div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> --}}
    </body>
</html>