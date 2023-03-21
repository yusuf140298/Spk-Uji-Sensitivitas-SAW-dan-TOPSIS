@section('myfeatures')

<div class="container d-flex">
	<div class="container col-3 mt-2 sticky-top">
		Total {{ $sumdataku }} Data Calon Penerima
	</div>
	<div class="container justify-content-center col-6">
		<form class="d-flex" action="{{ url ('/')}}">
			@csrf
			<input class="form-control me-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
			<button class="btn btn-outline-success" type="submit">Search</button>
		</form>
	</div>
	<div class="container justify-content-end col-2">
		@if (request()->segment(1)== null or 'ResultPage')
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Data</button>
		@endif
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Penerima</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="/store">
					@csrf
					<div class="mb-3">
						<label for="nik" class="form-label">NIK</label>
						<input type="text" class="form-control @error ('nik') is-invalid @enderror" id="nik" name="nik" placeholder="Masukan NIK" value="{{ old('nik') }}" required>
						@error('nik')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="nama" class="form-label">Nama Lengkap</label>
						<input type="text" class="form-control @error ('nama_lengkap') is-invalid @enderror" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
						@error('nama_lengkap')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="alamat" class="form-label">Alamat</label>
						<input type="text" class="form-control @error ('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukan Alamat" value="{{ old('alamat') }}" required>
						@error('alamat')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="rt" class="form-label">RT</label>
						<input type="text" class="form-control @error ('rt') is-invalid @enderror" id="rt" name="rt" placeholder="Masukan RT" value="{{ old('rt') }}" required>
						@error('rt')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="mb-3">
						<label for="rw" class="form-label">RW</label>
						<input type="text" class="form-control @error ('rw') is-invalid @enderror" id="rw" name="rw" placeholder="Masukan RW" value="{{ old('rw') }}" required>
						@error('rw')
							<div id="validationServerUsernameFeedback" class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					@foreach ($MyKriteria as $kriteria)
					<div class="mb-3">
						<input class="form-control" type="text" name="id[]" value="{{ $kriteria->id }}" hidden>
						<label for="c11" class="form-label">{{ $kriteria->kriteria }}</label>
						@foreach ($MySubKriteria->where('criteria_id', "$kriteria->id") as $subkriteria)
							<div class="form-check" >
								<input class="form-check-input" type="radio" name="kriteria[{{ $kriteria->id }}]" id="flexRadioDefault{{ $kriteria->id }}{{ $subkriteria->id }}" value="{{ $subkriteria->bobotsub }}" required>
								<label class="form-check-label" for="flexRadioDefault{{ $kriteria->id }}{{ $subkriteria->id }}">{{ $subkriteria->keterangan }}</label>
							</div>
						@endforeach
					</div>
					@endforeach
					<div class="d-flex justify-content-end">
						<button type="button" style="margin-right: 10px;" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Tambah Data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection