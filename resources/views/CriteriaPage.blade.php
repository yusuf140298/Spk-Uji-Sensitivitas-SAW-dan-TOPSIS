@extends('Layouts/MainLayout')
@section('title', 'Kritera')
@section('page', 'Kelola Data Kriteria')
@section('mycontent')
<div class="row justify-content-between">
	<div class="col-4">
		<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
			<div class="card-body">
				<h5 class="card-title text-center mb-4">Tambah Kriteria</h5>
				<form method="post" action="/criteriastore">
					@csrf
					<div class="mb-3">
						<label for="kriteria" class="form-label" style="margin-left: 1rem">Nama Kriteria</label>
						<input type="text" class="form-control rounded-pill @error ('kriteria') is-invalid @enderror" id="kriteria" name="kriteria" placeholder="Masukan Nama Kriteria" value="{{ old('kriteria') }}" required>
						@error('kriteria')
						<div id="validationServerUsernameFeedback" class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="row justify-content-between mb-3">
						<div class="col-6">
							<label for="bobot" class="form-label" style="margin-left: 1rem">Bobot</label>
							<input type="number" class="form-control rounded-pill @error ('bobot') is-invalid @enderror" id="bobot" name="bobot" placeholder="Masukan Bobot" value="{{ old('bobot') }}" required>
							@error('bobot')
								<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-6">
							<label for="jenis" class="form-label" style="margin-left: 1rem">Jenis</label>
							<select class="form-select" aria-label="Default select example" id="jenis" name="jenis">
								<option value="Benefit">Benefit</option>
								<option value="Cost">Cost</option>
							</select>
						</div>
					</div>
					<br>
					<button class="btn btn-primary col-12 rounded-pill" type="submit">Buat</button>
				</form>
			</div>
		</div>
	</div>
	
	<div class="col-7">
		<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
			<div class="container justify-content-center col-10 mb-3">
				<form class="d-flex" action="{{ url ('/CriteriaPage')}}">
					@csrf
					<input class="form-control me-2 text-center" type="search" id="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</div>
			
			<br>
			<div class="mytable">
				<table class="table table-hover ">
					<thead class="table-dark sticky-top">
						<tr>
							<td>No.</td>
							<td>Kriteria</td>
							<td>Bobot</td>
							<td>Jenis</td>
							<td>aksi</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($MyKriteria as $kriteria)	
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $kriteria->kriteria }}</td>
							<td>{{ $kriteria->bobot }}</td>
							<td>{{ $kriteria->jenis }}</td>
							<center>
								<td>
									<button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $kriteria->id }}">Edit</button>
									<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $kriteria->id }}">Delete</button>
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

@foreach ($MyKriteria as $kriteria)
<div class="modal fade" id="exampleModalEdit{{ $kriteria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Edit Kritera</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-4">
				<div class=" shadow-sm p-3 mb-5 bg-body rounded">
					<h5 class="card-title text-center mb-4">Edit Kriteria</h5>
					<form method="post" action="/updateCriteria/{{ $kriteria->id }}">
						@csrf
						<div class="mb-3">
							<label for="kriteria" class="form-label" style="margin-left: 1rem">Nama Kriteria</label>
							<input type="text" class="form-control rounded-pill @error ('kriteria') is-invalid @enderror" id="kriteria" name="kriteria" placeholder="Masukan Nama Kriteria" value="{{ old('kriteria', $kriteria->kriteria) }}" required>
							@error('kriteria')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="row justify-content-between mb-3">
							<div class="col-6">
								<label for="bobot" class="form-label" style="margin-left: 1rem">Bobot</label>
								<input type="number" class="form-control rounded-pill @error ('bobot') is-invalid @enderror" id="bobot" name="bobot" placeholder="Masukan Bobot" value="{{ old('bobot', $kriteria->bobot) }}" required>
								@error('bobot')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
									{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-6">
								<label for="jenis" class="form-label" style="margin-left: 1rem">Jenis</label>
								<select class="form-select" aria-label="Default select example" id="jenis" name="jenis">
									<option value="Benefit">Benefit</option>
									<option value="Cost">Cost</option>
								</select>
							</div>
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
@foreach ($MyKriteria as $kriteria)
<div class="modal fade" id="exampleModalDelete{{ $kriteria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Kritera</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<br>
				<h6>Apakah anda yain ingin menghapus Kriteria {{ $kriteria->kriteria }}</h6>
				<br>
				<form action="delete/{{ $kriteria->id }}" method="POST">
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