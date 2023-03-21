@extends('Layouts/MainLayout')
{{-- @extends('Layouts/MainFeature') --}}
@section('title','Metode TOPSIS')
@section('page','Data Penerima BLT Metode TOPSIS')
@section('mycontent')
<br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>1. Rating Kecocokan setiap Alternatif pada setiap Kriteria </h5>
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
			<tfoot class="sticky-bottom bg-white">
				<tr class="fw-bold text-center">
					<td  colspan="2">Pembagi</td>
					@foreach ($pembagi as $key => $bagi)
					<td class="fw-bold">{{ $bagi }}</td>
					@endforeach
				</tr>
			</tfoot>
		</table>
	</div>
	<br>
	<div class="d-flex justify-content-center">
		{{-- {{ $MyScore->links() }} --}}
	</div>
</div>

	<br><br><br>
														{{-- Kritera --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>Kriteria </h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark">
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
				<tr>
					<td class="text-center fw-bold" colspan="2">Jumlah</td>
					<td class="text-center">{{ $bsum }}</td>
					<td class="text-center">{{ $sumdecimal }}</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
	<br>
														{{--  HASIL TERNORMALISASI --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>2. Hasil Ternormalisasi</h5>
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
					@foreach ($normalisasi as $key => $mydata)
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
	<br><br><br>
													{{-- HASIL TERNORMALISASI DAN TERBOBOT --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>3. Hasil Ternormalisasi dan Terbobot</h5>
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
					@foreach ($norbot1 as $key => $mydata)
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
	<br><br><br>
	<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>Kriteria </h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark">
				<tr>
					<td>NO</td>
					<td>Nama Kriteria</td>
					<td>Jenis</td>
					<td>Max</td>
					<td>Min</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($MyKriteria as $mkey => $Kriteria)	
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $Kriteria->kriteria }}</td>
					<td>{{ $Kriteria->jenis }}</td>
					<td>{{ $max[$Kriteria->id] }}</td>
					<td>{{ $min[$Kriteria->id] }}</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
</div>
<br><br><br>
															{{-- Solusi Ideal Positif dan Negatif --}}
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>4. Nilai Solusi Ideal Positive dan Solusi Ideal Negative</h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td class="text-center">NO</td>
					<td class="text-center">Nama</td>
					<td class="text-center">Ideal Positif</td>
					<td class="text-center">Ideal Negatif</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($MyScore as $Data)	
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $Data->nama }}</td>
					@foreach ($positive as $key => $mydata)
						@if ($Data->id == $key)
							<td class="text-center">{{ $mydata }}</td>
							<td class="text-center">{{ $negative[$key] }}</td>
						@endif
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
	<br><br><br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>5. Hasil Nilai Preferensi Alternatif</h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td class="text-center">NO</td>
					<td class="text-center">Nama</td>
					<td class="text-center">Preferensi</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($MyScore as $Data)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $Data->nama }}</td>
						@foreach ($preference as $key1 => $mydata)
							@if ($Data->id == $key1)
								<td class="text-center">{{ $mydata }}</td>
							@endif
						@endforeach
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
	<br><br><br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>5. Hasil Perankingan Alternatif</h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					{{-- <td class="text-center">NO</td> --}}
					<td>Nama</td>
					<td class="text-center">Preferensi</td>
					<td class="text-center">Ranking</td>
				</tr>
			</thead>
			<tbody>
				@php
					$i = 1;
				@endphp
				@foreach ($ranktopsis as $key => $rank)
					@foreach ($MyScore as $Data)
						@if ($key == $Data->id)
							<tr>
								{{-- <td class="text-center">{{ $loop->iteration }}</td> --}}
								<td>{{ $Data->nama }}</td>
								@foreach ($preference as $key1 => $mydata)
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
<br><br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>Hasil Metode TOPSIS</h5>
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
				@foreach ($mypreference as $key => $data)
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
			{{-- {{ $MyData->links() }}	 --}}
		</div>
	<br>
</div>
	@endsection
