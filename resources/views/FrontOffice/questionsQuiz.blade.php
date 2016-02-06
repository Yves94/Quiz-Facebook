@extends('welcome')

@section('title', 'Questions')

@section('content')

<div class="row questionHeader">
	<div class="col-xs-4"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;2 / 8</div>
	<div class="col-xs-4 text-center">
		<div class="joker"><span class="glyphicon glyphicon-star"></span></div>
		<div class="joker"><span class="glyphicon glyphicon-star"></span></div>
		<div class="joker"><span class="glyphicon glyphicon-star"></span></div>
	</div>
	<div class="col-xs-4 text-right">4 <span class="glyphicon glyphicon-time"></span></div>
</div>

<div class="progress questionProgressTime">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    <span class="sr-only">60% Complete</span>
  </div>
</div>

<div class="row jumbotron questionContainer">
	<div class="col-md-10 col-md-offset-1 text-center questionContent">You can use inline-flex as well which works pretty good and may be a little cleaner than modifying every row element with CSS.?</div>
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