@extends('Layouts/MainLayout')
{{-- @extends('Layouts/MainFeature') --}}
@section('title','Uji Sensitivitas')
@section('page','Uji Sensitivitas Metode SAW dan TOPSIS')
@section('mycontent')
<br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>Rating Kecocokan setiap Alternatif pada setiap Kriteria </h5>
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
<br>
	<div class="d-flex justify-content-center">
		{{-- {{ $MyData->links() }} --}}
	</div>
<br><br><br>
<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
	<div class="card-header d-flex justify-content-between bg-white">
		<h5>Kriteria </h5>
	</div>
	<br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td>NO</td>
					<td>Nama Kriteria</td>
					<td class="text-center">Bobot</td>
					<td class="text-center">Decimal</td>
					<td>Jenis</td>
				</tr>
			</thead>
			<tbody>
				
				@foreach ($MyKriteria as $Kriteria)	
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $Kriteria->kriteria }}</td>
					<td class="text-center">{{ $Kriteria->bobot }}</td>
					<td class="text-center">{{ $decimal[$kriteria->id] }}</td>
					<td>{{ $Kriteria->jenis }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="fw-bold">
					<td class="text-center fw-bold sticky-bottom" colspan="2">Jumlah</td>
					<td class="text-center">{{ $bsum }}</td>
					<td class="text-center">{{ $sumdecimal }}</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
	<br><br><br>
	<div class="d-flex justify-content-center">
		<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
			<div class="card-header d-flex justify-content-between bg-white">
				<h6>Hasil Preferensi Metode SAW dan TOPSIS sebelum uji Sensitivitas</h6>
			</div>
			<div class="col-5">
				<br>
				<div class="MyTable2">
					<table class="table table-hover">
						<thead class="table-dark sticky-top">
							<tr>
								<td>NO</td>
								<td>Nama</td>
								<td>SAW</td>
								<td>TOPSIS</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($MyScore as $data)	
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $data->nama }}</td>
								<td>{{ $sawpreference[$data->id] }}</td>
								
								<td>{{ $preference[$data->id] }}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr class="bg-white fw-bold sticky-bottom">
								<td class="text-center" colspan="2">Max</td>
								<td>{{ $sawpreferencemax }}</td>
								<td>{{ $preferencemax }}</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="d-flex justify-content-center">
					{{-- {{ $MyData->links() }} --}}
				</div>
			</div>
		</div>
	</div>

	@foreach ($sensipreference as $key => $sensitopsis)
	<br><br><br>
	<div class="card border shadow-lg p-3 mb-5 bg-white rounded">
		<div class="card-header d-flex justify-content-between bg-white">
			<h4 class="text-center">Tahap {{ $key+1; }}</h4>
		</div>
		<br>
		<div class="container d-flex justify-content-between">
			<div class="col-6">
				Merubah bobot Kriteria awal dari 
				@foreach ($MyKriteria as $kriteria)
				{{ ($kriteria->bobot/$bsum).',' }}
				@endforeach
				<br>
				Ditambah sebesar 0.5 sehingga Keriteria {{ $key+1 }}. Menjadi
				@foreach ($mysensi as $mkey => $sensi)
					@if ($mkey == $key)
						@foreach ($sensi as $mkey1 => $sensi1)
							{{ $sensi1.',' }}
						@endforeach
					@endif
				@endforeach
				<br><br>
				<div class="MyTable2">
					<table class="table table-hover">
						<thead class="table-dark sticky-top">
							<tr>
								<td>NO</td>
								<td>Nama</td>
								<td>SAW</td>
								<td>TOPSIS</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($sensitopsis as $key1 => $data)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $MyScore->where('id', $key1)->value('nama') }}</td>
									<td>{{ $sensisawpreference[$key][$key1] }}</td>
									<td>{{ $data }}</td>
								</tr>
							@endforeach
							
						</tbody>
						<tfoot>
							<tr class="sticky-bottom bg-white fw-bold">
								<td colspan="2" class="text-center">Max</td>
								<td>{{ $sensisawpreferencemax[$key] }}</td>
								<td>{{ $sensipreferencemax[$key] }}</td>
							</tr>
							<tr class="bg-white fw-bold sticky-bottom">
								<td colspan="2" class="text-center">Presentase</td>
								<td>{{ $precentagesensisawpreference[$key] }}</td>
								<td>{{ $precentagesensipreferencemax[$key] }}</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<br>
				<div class="d-flex justify-content-center">
					{{-- {{ $MyData->links() }} --}}
				</div>
				<br>
			</div>
			<div class="col-5" style="margin-right: 3rem">
				Merubah bobot Kriteria awal dari 
				@foreach ($MyKriteria as $kriteria)
				{{ ($kriteria->bobot/$bsum).',' }}
				@endforeach
				<br>
				Ditambah sebesar 1 sehingga Keriteria {{ $key+1 }}. Menjadi
				@foreach ($mysensi1 as $mkey => $sensi)
					@if ($mkey == $key)
						@foreach ($sensi as $mkey1 => $sensi1)
							{{ $sensi1.',' }}
						@endforeach
					@endif
				@endforeach
				<br><br>
				<div class="MyTable2">
					<table class="table table-hover">
						<thead class="table-dark sticky-top">
							<tr>
								<td>NO</td>
								<td>Nama</td>
								<td>SAW</td>
								<td>TOPSIS</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($sensitopsis as $key1 => $data)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $MyScore->where('id', $key1)->value('nama') }}</td>
									<td>{{ $sensisawpreference1[$key][$key1] }}</td>
									<td>{{ $sensipreference1[$key][$key1] }}</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr class="sticky-bottom bg-white fw-bold">
								<td colspan="2" class="text-center">Max</td>
								<td>{{ $sensisawpreferencemax1[$key] }}</td>
								<td>{{ $sensipreferencemax1[$key] }}</td>
							</tr>
							<tr class="bg-white fw-bold sticky-bottom">
								<td colspan="2" class="text-center">Presentase</td>
								<td>{{ $precentagesensisawpreference1[$key] }}</td>
								<td>{{ $precentagesensipreferencemax1[$key] }}</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="d-flex justify-content-center">
					{{-- {{ $MyData->links() }} --}}
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<br><br><br><br><br><br>
	<div class="MyTable">
		<table class="table table-hover">
			<thead class="table-dark sticky-top">
				<tr>
					<td>NO</td>
					<td>Kreiteria</td>
					<td>SAW</td>
					<td>TOPSIS</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($sensitiv as $key => $data)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $data }}</td>
						<td>{{ $sensitivsaw[$key] }}</td>
						<td>{{ $sensitivtopsis[$key] }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="sticky-bottom bg-white fw-bold">
					<td colspan="2" class="text-center">jumlah</td>
					<td>{{ $sumsensitivsaw.'%' }}</td>
					<td>{{ $sumsensitivtopsis.'%' }}</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<br><br><br><br><br><br>
@endsection