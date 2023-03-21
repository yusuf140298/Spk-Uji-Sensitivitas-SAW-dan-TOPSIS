@extends('Layouts/MainLayout')
{{-- @extends('Layouts/MainFeature') --}}
@section('title','Hasil Penerima BLT')
{{-- @section('page','Hasil Penerima BLT') --}}
@section('mycontent')
<center>
	<h1>Hasil Penerima BLT {{ $MyPage }}</h1>
</center>
<br><br>
<div class="container d-flex">
	<div class="container mt-2 col-3 sticky-top">
		{{ $filter }} Dari Total {{ $sumdataku }} Data Penerima
	</div>
	<div class="container justify-content-center col-6">
		<form class="d-flex" action="{{ url ('/ResultPage')}}">
			@csrf
			<input class="form-control me-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
			<button class="btn btn-outline-success" type="submit">Search</button>
		</form>
	</div>
	<div class="container justify-content-end col-2">
		<form class="d-flex" action="{{ url ('/ResultPage')}}">
			@csrf
			<input class="form-control me-2" type="number" id="filter" name="filter" placeholder="Filter Data" aria-label="Search" value="{{ request('filter') }}">
			<button class="btn btn-outline-primary" type="submit">Filter</button>
		</form>
	</div>
	{{-- <div class="container justify-content-end col-2">
		@if (request()->segment(1)== null or 'ResultPage')
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Data</button>
		@endif
	</div> --}}
</div>
<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td>NO</td>
					{{-- <td>Nik</td> --}}
					<td>Nama</td>
					@foreach ($MyKriteria as $kriteria)
						<td>{{ $kriteria->kriteria }}</td>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@php
					$i = 1;
				@endphp
				@foreach ($preference as $key => $data)
					@foreach ($MyData as $key1 => $data1)
						@if ($key == $data1->id)
							<tr>
								<td>{{ $i }}</td>
								{{-- <td>{{ $data1->nik }}</td> --}}
								<td>{{ $data1->nama }}</td>
								@foreach ($data1->criterias as $key2 => $data2)
									@foreach ($MySubKriteria as $data3)
										@if ($data2->id == $data3->criteria_id)
											@if ($data2->pivot->nilai == $data3->bobotsub)
												<td class="">{{ $data3->keterangan }}</td>
											@endif
										@endif
									@endforeach
								@endforeach
							</tr>
						@endif
					@endforeach
					@php
						$i++;
					@endphp
					@endforeach
			</tbody>
		</table>
	</div>
	<br>
		<div class="d-flex justify-content-center">
			{{ $preference->links() }}
		</div>
	<br>
	@endsection

