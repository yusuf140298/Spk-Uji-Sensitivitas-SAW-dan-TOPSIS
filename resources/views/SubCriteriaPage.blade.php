@extends('Layouts/MainLayout')
@section('title','Sub Kritera')
@section('page','Data Sub Kriteria')
@section('mycontent')
<div class="container">
	@foreach ($MyKriteria as $kriteria)	
	<div class="card shadow-sm p-3 mb-5 bg-body rounded">
		<div class="card-header d-flex justify-content-between">
			<h5>{{ $loop->iteration }}. Kriteria {{ $kriteria->kriteria }} / {{ $kriteria->jenis }}</h5>
			<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addexampleModal{{ $kriteria->id }}">+ Data SubKriteria</button>
		</div>
		<div class="card-body">
			<div class="mytable">
				<table class="table table-hover ">
					<thead class="table-dark">
						<tr>
							<td>No.</td>
							<td>Keterangan</td>
							<td>Nilai</td>
							<td>aksi</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($MySubKriteria->where('criteria_id', "$kriteria->id") as $subkriteria)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $subkriteria->keterangan }}</td>
							<td>{{ $subkriteria->bobotsub }}</td>
							<center>
								<td>
									<button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $subkriteria->id }}">Edit</button>
									<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $subkriteria->id }}">Delete</button>
								</td>
							</center>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br>
	{{-- <div class="d-flex justify-content-center mt-3">
		{{ $MyUser->links() }}
	</div> --}}
	@endforeach
</div>
@foreach ($MyKriteria as $kriteria)
<div class="modal fade" id="addexampleModal{{ $kriteria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">tambah Sub Kritera</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="/storesub" method="POST">
					@csrf
					<div class="mb-3" hidden>
						<label for="criteria_id" class="form-label">id</label>
						<input type="text" class="form-control @error ('criteria_id') is-invalid @enderror" id="criteria_id" name="criteria_id" placeholder="Masukan Keterangan" value="{{ $kriteria->id }}" required>
						@error('criteria_id')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="keterangan" class="form-label">Keterangan</label>
						<textarea type="text" class="form-control @error ('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" placeholder="Masukan Keterangan" value="{{ old('keterangan') }}" required></textarea>
						@error('keterangan')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="bobotsub" class="form-label">nilai</label>
						<input type="number" class="form-control @error ('bobotsub') is-invalid @enderror" id="bobotsub" name="bobotsub" placeholder="Masukan Nilai" value="{{ old('bobotsub') }}" required>
						@error('bobotsub')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="d-flex justify-content-end">
						<button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

@foreach ($MySubKriteria as $subkriteria)
<div class="modal fade" id="exampleModalEdit{{ $subkriteria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Sub Kritera</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="/updateSub/{{ $subkriteria->id }}" method="POST">
					@csrf
					@foreach ($MyKriteria as $kriteria)
						@if ($kriteria->id == $subkriteria->criteria_id)
							<div class="mb-3" hidden>
								<input type="text" class="form-control @error ('mybot') is-invalid @enderror" id="mybot" name="mybot" placeholder="Masukan Keterangan" value="{{ $subkriteria->bobotsub }}" required readonly hidden>
								<input type="text" class="form-control @error ('criteria_id') is-invalid @enderror" id="criteria_id" name="criteria_id" placeholder="Masukan Keterangan" value="{{ $kriteria->id }}" required readonly hidden>
								@error('criteria_id')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						@endif
					@endforeach
					<div class="mb-3">
						<label for="keterangan" class="form-label">Keterangan</label>
						<textarea type="text" class="form-control @error ('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" placeholder="{{ $subkriteria->keterangan }}" value="{{ old($subkriteria->keterangan) }}" required>{{ $subkriteria->keterangan }}</textarea>
						@error('keterangan')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="bobotsub" class="form-label">nilai</label>
						<input type="number" class="form-control @error ('bobotsub') is-invalid @enderror" id="bobotsub" name="bobotsub" placeholder="Masukan Nilai" value="{{ old('bobotsub', $subkriteria->bobotsub) }}" required>
						@error('bobotsub')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="d-flex justify-content-end">
						<button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Perbarui</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

@foreach ($MySubKriteria as $subkriteria)
<div class="modal fade" id="exampleModalDelete{{ $subkriteria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Sub Kritera</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<br>
				<h6>Apakah anda yain ingin menghapus Sub Kriteria {{ $subkriteria->keterangan }}</h6>
				<br>
				<form action="deletesub/{{ $subkriteria->id }}" method="POST">
					@csrf
					@foreach ($MyKriteria as $kriteria)
						@if ($kriteria->id == $subkriteria->criteria_id)
							<div class="mb-3">
								<input type="text" class="form-control @error ('mybot') is-invalid @enderror" id="mybot" name="mybot" placeholder="Masukan Keterangan" value="{{ $subkriteria->bobotsub }}" required readonly hidden>
								<input type="text" class="form-control @error ('criteria_id') is-invalid @enderror" id="criteria_id" name="criteria_id" placeholder="Masukan Keterangan" value="{{ $kriteria->id }}" required readonly hidden>
								@error('criteria_id')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						@endif
					@endforeach
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