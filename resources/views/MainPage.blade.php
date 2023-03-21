@extends('Layouts/MainLayout')
@extends('Layouts/MainFeature')
@section('title','Daftar Calon Penerima BLT')
@section('page','Data Calon Penerima BLT')
@section('mycontent')
<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td>NO</td>
					{{-- <td>Nik</td> --}}
					<td>Nama</td>
					@foreach ($MyKriteria as $scores)
						<td>{{ $scores->kriteria }}</td>
					@endforeach
					<td>Aksi</td	>
				</tr>
			</thead>
			<tbody>
				@foreach ($MyData as $score )
				<tr>	
					<td>{{ ($MyData->currentPage()-1) * $MyData->perpage() + $loop->iteration }}</td>
					{{-- <td>{{ $score->nik }}</td> --}}
					<td>{{ $score->nama }}</td>
					@foreach ($score->criterias as $criteria )
						@foreach ($MySubKriteria as $data)
							@if($criteria->id == $data->criteria_id)
								{{-- @if($criteria->pivot->nilai == $data->bobotsub) --}}
									@php
										if($criteria->pivot->nilai == $data->bobotsub){
											$mydata[$criteria->id] = $data->keterangan;
										}elseif($criteria->pivot->nilai == 0){
											$mydata[$criteria->id] = $criteria->pivot->nilai;
										}
										// dd($mydata);
									@endphp
								{{-- <td>{{ $data->keterangan }}</td> --}}
								{{-- @endif --}}
							@endif
						@endforeach
					@endforeach
					@foreach ($mydata as $my)
						<td @if ($my == 0) class="bg-warning" @endif>{{ $my }}</td>
					@endforeach
					<center>
						<td>
							<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDetail{{ $score->id }}">Detail</button>
							<button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $score->id }}">Edit</button>
							<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $score->id }}">Delete</button>
						</td>
					</center>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<br>
		<div class="d-flex justify-content-center">
			{{ $MyData->links() }}
		</div>
	<br>
	@foreach ($MyData as $score)
	<div class="modal fade" id="exampleModalDetail{{ $score->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<br>
					<h6>{{ "NIK : $score->nik" }}</h6>
					<h6>{{ "Nama : $score->nama" }}</h6>
					<h6>{{ "Alamat : $score->alamat" }}</h6>
					<h6>{{ "RT : $score->rt" }}</h6>
					<h6>{{ "RW : $score->rw" }}</h6>
					<br>
					<div class="d-flex justify-content-end">
						<button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@foreach ($MyData as $score)
		<div class="modal fade" id="exampleModalEdit{{ $score->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Data Calon Penerima</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="post" action="/updateData/{{ $score->id }}">
							{{-- @method('put') --}}
							@csrf
							<div class="mb-3">
								<input type="text" class="form-control @error ('nik') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ $score->id }}" required readonly hidden>
							</div>
							<div class="mb-3">
								<label for="nik" class="form-label">NIK</label>
								<input type="text" class="form-control @error ('nik') is-invalid @enderror" id="nik" name="nik" placeholder="Masukan NIK" value="{{ old('nik', $score->nik) }}" required>
								@error('nik')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="nama" class="form-label">Nama Lengkap</label>
								<input type="text" class="form-control @error ('nama_lengkap') is-invalid @enderror" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value="{{ old('nama', $score->nama) }}" required>
								@error('nama_lengkap')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="alamat" class="form-label">Alamat</label>
								<input type="text" class="form-control @error ('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukan Alamat" value="{{ old('alamat', $score->alamat) }}" required>
								@error('alamat')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="rt" class="form-label">RT</label>
								<input type="text" class="form-control @error ('rt') is-invalid @enderror" id="rt" name="rt" placeholder="Masukan RT" value="{{ old('rt', $score->rt) }}" required>
								@error('rt')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="rw" class="form-label">RW</label>
								<input type="text" class="form-control @error ('rw') is-invalid @enderror" id="rw" name="rw" placeholder="Masukan RW" value="{{ old('rw', $score->rw) }}" required>
								@error('rw')
									<div id="validationServerUsernameFeedback" class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							@foreach ($MyKriteria as $key => $kriteria)
								<div class="mb-3">
									<input class="form-control" type="text" name="id[]" value="{{ $kriteria->id }}" hidden>
									<label for="c11" class="form-label">{{ $kriteria->kriteria }}</label>
									@foreach ($score->criterias as $criteria )
										@foreach ($MySubKriteria->where('criteria_id', "$kriteria->id") as $subkriteria)
											@if ($criteria->id == $kriteria->id)
											<div class="form-check">
												<input class="form-check-input" type="radio" name="kriteria[{{ $kriteria->id }}]" id="flexRadio{{ $score->id }}{{ $kriteria->id }}{{ $subkriteria->id }}" value="{{ $subkriteria->bobotsub }}"{{ $subkriteria->bobotsub == $criteria->pivot->nilai ? 'checked' : ''}}>
												{{-- <input class="form-check-input" type="radio" name="criteria_id[{{ $kriteria->id }}]" id="flexRadio{{ $score->id }}{{ $kriteria->id }}{{ $subkriteria->id }}" value="{{ $subkriteria->bobotsub }}"> --}}
												<label class="form-check-label" for="flexRadio{{ $score->id }}{{ $kriteria->id }}{{ $subkriteria->id }}">{{ $subkriteria->keterangan }}</label>
											</div>
											@endif
										@endforeach
									@endforeach
								</div>
							@endforeach
							<div class="d-flex justify-content-end">
								<button type="button" style="margin-right: 10px;" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Update Data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	@foreach ($MyData as $score)
	<div class="modal fade" id="exampleModalDelete{{ $score->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<br>
					<h6>Apakah anda yain ingin menghapus Data {{ $score->nama }}</h6>
					<br>
					<form action="deleteData/{{ $score->id }}" method="POST">
						{{-- @method('delete') --}}
						@csrf
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endsection

