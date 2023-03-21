<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
		<title>@yield( 'title' )</title>
		<style>
			.MyTable{
				height: 23rem ;
				overflow: scroll;
			}
			.MyTable2{
				height: 23rem;
				width: 35rem;
				overflow: scroll;
			}
			.mytable{
				height: 25rem ;
				overflow: scroll;
			}
		</style>
	</head>
	<body>
		@auth
		<div class="modal fade" id="ChangePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="post" action="/UpdatePassword">
							@csrf
							<div class="mb-3">
								<label for="current_password" class="form-label" style="margin-left: 1rem">Password saat ini</label>
								<input type="password" class="form-control rounded-pill @error ('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Masukan Password Lama Anda" value="" autofocus required>
								@error('current_password')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="password" class="form-label" style="margin-left: 1rem">Password Baru</label>
								<input type="Password" class="form-control rounded-pill @error ('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan Password Baru" value="{{ old('password') }}" required>
								@error('password')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="password_confirmation" class="form-label" style="margin-left: 1rem">Konfirmasi Password Baru</label>
								<input type="Password" class="form-control rounded-pill @error ('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru anda" value="" required>
								@error('password_confirmation')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<br>
							<button class="btn btn-primary col-12 rounded-pill" type="submit">Ubah Password</button>
						</form>
					</div>
					<div class="modal-footer">
						<br>
					</div>
				</div>
			</div>
		</div>
		@endauth
		@can('Administrator')
		<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="container mt-5">
					<h6 class="text-center mb-2">{{ auth()->user()->name }}</h6>
					<h6 class="text-center">{{ auth()->user()->role->role }}</h6>
					<ul class="navbar-nav">
						<hr>
						<li class="nav-item">
							<a class="nav-link {{ request()->segment(1) == 'RegisterPage' ? 'fw-bold' : '' }}" style="margin-left: 15px" href="{{ url ('/RegisterPage')}}">Kelola User</a>
						</li>
						<hr>
						<li class="nav-item">
							<a class="nav-link {{ request()->segment(1) == 'CriteriaPage' ? 'fw-bold' : '' }}" style="margin-left: 15px" href="{{ url ('/CriteriaPage')}}">Kriteria</a>
						</li>
						<hr>
						<li class="nav-item">
							<a class="nav-link {{ request()->segment(1) == 'SubCriteriaPage' ? 'fw-bold' : '' }}" style="margin-left: 15px" href="{{ url ('/SubCriteriaPage')}}">Sub Kriteria</a>
						</li>
						<hr>
						<li class="nav-item">
							<a class="nav-link {{ request()->segment(1) == 'SawPage' ? 'fw-bold' : '' }}" style="margin-left: 15px" href="{{ url ('/SawPage')}}">SAW</a>
						</li>
						<hr>
						<li class="nav-item">
							<a class="nav-link {{ request()->segment(1) == 'TopsisPage' ? 'fw-bold' : '' }}" style="margin-left: 15px" href="{{ url ('/TopsisPage')}}">TOPSIS</a>
						</li>
						<hr>
						<li class="nav-item">
							<a class="nav-link {{ request()->segment(1) == 'SensitivPage' ? 'fw-bold' : '' }}" style="margin-left: 15px" href="{{ url ('/SensitivPage')}}">Uji Sensitivitas</a>
						</li>
						<hr>
					</ul>
				</div>
			</div>
		</div>
		@endcan

		<nav class="navbar navbar-expand-lg navbar-light p-3 shadow p-3 fixed-top" tabindex="1" style="background-color: #4fe0a6;">
			@can('Administrator')
				<a class="btn btn-lg" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="bi bi-list"></i></a>
			@endcan
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="container justify-content-center">
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link fw-bold {{ request()->segment(1) == '' ? 'active' : '' }}" href="{{ url ('/')}}">Daftar Penerima</a>
						</li>
						<li class="nav-item ml-3">
							<a class="nav-link fw-bold {{ request()->segment(1) == 'ResultPage' ? 'active' : '' }}" href="{{ url ('/ResultPage')}}">Penerima BLT</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="container col-4 justify-content-center">
				@auth
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#"></a></li>
							<button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ChangePassword">Ubah Password</button>
							<li><hr class="dropdown-divider"></li>
							<center>
								<form action="/Logout" method="POST">
									@csrf
									<button class="btn btn-danger" type="submit">Logout</button>
								</form>
							</center>
						</ul>
					</li>
				</ul>
				@endauth
			</div>
		</nav>
		<br><br><br>
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
		
		@auth
		<center>
			<br><br><br>
			<h1>@yield('page')</h1>
		</center>
			<br>
			@yield('myfeatures')
			@yield('mycontent2')
			<div class="container">
				@yield('mycontent')
			</div>
		@endauth

		@guest
		<br><br><br><br><br><br><br>
		<h1 class="d-flex justify-content-center">Silahkan Login Terlebih Dahulu</h1>
		<br>
		<div class="d-flex justify-content-center">
            <a href="{{ url ('/LoginPage')}}" class="btn btn-primary fs-4 col-2">Login</a>
		</div>
		@endguest
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	</body>
</html>

