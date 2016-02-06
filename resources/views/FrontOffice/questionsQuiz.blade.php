@extends('welcome')

@section('title', 'Questions')

@section('content')

<div class="row questionHeader">
	<div class="col-md-6">Question X sur X</div>
	<div class="col-md-6 text-right">4 <span class="glyphicon glyphicon-time"></span></div>
</div>
<div class="row jumbotron">
	<div class="col-md-6 col-md-offset-3 text-center questionContent">En quel année je serai ?</div>
</div>

<div class="list-group answersContent">
	<button type="button" class="list-group-item">Cras justo odio</button>
	<button type="button" class="list-group-item">Dapibus ac facilisis in</button>
	<button type="button" class="list-group-item">Morbi leo risus</button>
	<button type="button" class="list-group-item">Porta ac consectetur ac</button>
	<button type="button" class="list-group-item">Vestibulum at eros</button>
</div>

<div class="row">
	<div class="text-right">
		<button class="btn btn-primary">Valider la réponse</button>
	</div>
</div>


@endsection