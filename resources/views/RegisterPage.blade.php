@extends('Layouts/MainLayout')
@section('title', 'Kelola User')
@section('page', 'Kelola Data User')
@section('mycontent')
<div class="row justify-content-between">
	<div class="col-4">
		<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
			<div class="card-body">
				<h5 class="card-title text-center mb-4">Tambah User</h5>
				<form method="post" action="/UserStore">
					@csrf
					<div class="mb-3">
						<label for="nip" class="form-label" style="margin-left: 1rem">NIP</label>
						<input type="number" class="form-control rounded-pill @error ('nip') is-invalid @enderror" id="nip" name="nip" placeholder="Masukan NIP" value="{{ old('nip') }}" required>
						@error('nip')
						<div id="validationServerUsernameFeedback" class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="nama" class="form-label" style="margin-left: 1rem">Nama Lengkap</label>
						<input type="text" class="form-control rounded-pill @error ('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value="{{ old('nama') }}" required>
						@error('nama')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
							{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="password" class="form-label" style="margin-left: 1rem">Password</label>
						<input type="password" class="form-control rounded-pill @error ('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan Bobot" value="" required>
						@error('password')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
							{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="level" class="form-label" style="margin-left: 1rem">Level User</label>
						<select class="form-select" aria-label="Default select example" id="level" name="level">
							@foreach ($roles as $role)
								<option value="{{ $role->id }}">{{ $role->role }}</option>
							@endforeach
						</select>
					</div>
					<br>
					<button class="btn btn-primary col-12 rounded-pill" type="submit">Buat</button>
				</form>
			</div>
		</div>
	</div>
	
	<div class="col-7">
		<div class="card shadow-lg p-3 mb-5 bg-white rounded">
			<div class="container justify-content-center col-10 mb-3">
				<form class="d-flex" action="{{ url ('/RegisterPage')}}">
					@csrf
					<input class="form-control me-2 text-center " type="search" id="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</div>
			
			<br>
			<div class="mytable">
				<table class="table table-hover ">
					<thead class="table-dark">
						<tr>
							<td>No.</td>
							<td>NIP</td>
							<td>Nama</td>
							<td>Role</td>
							<td>aksi</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)	
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $user->nip }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->role->role }}</td>
							<center>
								<td>
									{{-- @if (auth()->user()->nip == $user->nip)
										
									@else --}}
									<button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $user->id }}">Edit</button>
									<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $user->id }}">Delete</button>
									{{-- @endif --}}
								</td>
							</center>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="d-flex justify-content-center mt-3">
				{{-- {{ $MyUser->links() }} --}}
			</div>
		</div>
	</div>
</div>

@foreach ($users as $user)
<div class="modal fade" id="exampleModalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Edit User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-4">
				<div class=" shadow-sm p-3 mb-5 bg-body rounded">
					<h5 class="card-title text-center mb-4">Edit User</h5>
					<form method="post" action="UpdateUser/{{ $user->id }}">
						@csrf
						<div class="mb-3">
							<label for="nipup" class="form-label" style="margin-left: 1rem">NIP</label>
							<input type="text" class="form-control rounded-pill @error ('nipup') is-invalid @enderror" id="nipup" name="nipup" placeholder="Masukan NIP" value="{{ old('nipup', $user->nip) }}" required>
							@error('nipup')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="namaup" class="form-label" style="margin-left: 1rem">Nama Lengkap</label>
							<input type="text" class="form-control rounded-pill @error ('namaup') is-invalid @enderror" id="namaup" name="namaup" placeholder="Masukan Nama" value="{{ old('namaup', $user->name) }}" required>
							@error('namaup')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-3">
						<label for="levelup" class="form-label" style="margin-left: 1rem">Level User</label>
						<select class="form-select" aria-label="Default select example" id="levelup" name="levelup">
							<option {{ $user->role->role == $role->role ? 'fw-bold' : '' }} value="{{ $user->role->id }}">{{ $user->role->role }}</option>
							@foreach ($roles as $role)
								@if ($role->id != $user->role->id)
								<option value="{{ $role->id }}">{{ $role->role }}</option>
								@endif
							@endforeach
						</select>
					</div>
						<br>
						<button class="btn btn-outline-success col-12 rounded-pill" type="submit">Edit</button>
					</form>
				</div>
				<div class="d-flex justify-content-end">
					<button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@foreach ($users as $user)
<div class="modal fade" id="exampleModalDelete{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<br>
				<h6>Apakah anda yain ingin menghapus User {{ $user->name }}</h6>
				<br>
				<form action="DeleteUser/{{ $user->id }}" method="POST">
					@csrf
					<div class="d-flex justify-content-end">
						<button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-danger" data-bs-dismiss="modal">hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection