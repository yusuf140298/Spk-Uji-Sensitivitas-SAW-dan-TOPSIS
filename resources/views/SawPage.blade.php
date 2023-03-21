@extends('Layouts/MainLayout')
{{-- @extends('Layouts/MainFeature') --}}
@section('title','Metode SAW')
@section('page','Data Penerima BLT Metode SAW')
@section('mycontent')
<br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5> 1. Rating Kecocokan setiap Alternatif pada setiap Kriteria </h5>
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
						<td class="text-center">{{ $kriteria->kriteria }}</td>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($MyScore as $Data)	
				<tr>
					<td>{{ $loop->iteration }}</td>
					{{-- <td>{{ $Data->nik }}</td> --}}
					<td>{{ $Data->nama }}</td>
					@foreach ($Data->criterias as $mydata)
						<td class="text-center">{{ $mydata->pivot->nilai }}</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
	<br><br><br>
		{{-- <div class="d-flex justify-content-center">
			{{ $MyScore->links() }}
		</div> --}}
	<br>
														{{-- Kritera --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5> Kriteria </h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td>NO</td>
					<td>Nama Kriteria</td>
					<td>Bobot</td>
					<td>Decimal</td>
					<td>Jenis</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($MyKriteria as $Kriteria)	
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $Kriteria->kriteria }}</td>
					<td class="text-center">{{ $Kriteria->bobot }}</td>
					<td class="text-center">{{ $decimal[$Kriteria->id] }}</td>
					<td>{{ $Kriteria->jenis }}</td>
				</tr>
				@endforeach
				<tr class="sticky-bottom">
					<td class="text-center fw-bold" colspan="2">Jumlah</td>
					<td class="text-center">{{ $bsum }}</td>
					<td class="text-center">{{ $sumdecimal }}</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
	<br><br><br><br><br><br><br><br>
														{{--  HASIL TERNORMALISASI --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>2. Matriks Keputusan Berdasarkan Kriteria </h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td>NO</td>
					<td>Nama</td>
					@foreach ($MyKriteria as $kriteria)
						<td class="text-center">{{ $kriteria->kriteria }}</td>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($MyScore as $Data)	
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $Data->nama }}</td>
					@foreach ($sawnormal as $key => $mydata)
						@foreach ($mydata as $key1 => $data)
							@if ($Data->id == $key)
								<td class="text-center">{{ $data }}</td>
							@endif
						@endforeach
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
	<br><br><br><br><br><br><br><br>
													{{-- HASIL Preferensi --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>3. Hasil Akhir Nilai Preferensi </h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td class="text-center">NO</td>
					<td class="text-center">Nama</td>
					<td class="text-center">Nilai Preferensi</td>
					<td class="text-center">Ranking</td>
				</tr>
			</thead>
			<tbody>
				@php
					$i = 1;
				@endphp
				@foreach ($ranksaw as $key => $data)
					@foreach ($MyScore as $Data)	
						@if ($key == $Data->id)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $Data->nama }}</td>
								@foreach ($sawpreference as $key1 => $mydata)
									@if ($Data->id == $key1)
										<td class="text-center">{{ $mydata }}</td>
									@endif
								@endforeach
								<td class="text-center">{{ $i }}</td>
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
</div>
<br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>Hasil Metode SAW</h5>
	</div>
	<br>
	<div class="">
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
			{{-- {{ $MyData->links() }} --}}
		</div>
	<br>
</div>
	<br><br><br><br><br><br><br>
@endsection
