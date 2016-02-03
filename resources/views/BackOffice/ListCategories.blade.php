@extends('Layout.BackOffice')

@section('title', 'Les Categories')

@section('sidebar')
@parent
@endsection

@section('content')
<div class="container">
        <div class="row">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/category/list','method'=>'POST']) !!}
            <div class="form-group">
                {!! Form::text('search',null, ['class' => 'form-control', 'placeholder' => 'Rechercher']) !!}
                <i class="glyphicon glyphicon-search form-control-feedback" style="margin-right: 20px; line-height: 39px"></i>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <h2>Toutes les Catégories</h2> 
    <div class="row add">
        <div class="col-md-12">
           <a href="{{url('admin/category/add')}}">
             <span class="glyphicon glyphicon-plus-sign"></span>
             Ajouter
         </a>
     </div>
 </div>    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover ">
                <tr>
                    <th>
                        {{ 'Id' }}
                    </th>
                    <th>
                        {{ 'Categorie' }}
                    </th>
                    <th>
                        {{ 'Supprimer' }}
                    </th>
                </tr>

                @foreach ($categories as $k => $category)

                <tr @if($k%2==0) class="info" @endif>
                    <td>
                        {{ $category->id_category }}
                    </td>
                    <td>
                        {{ $category->wording_category }}
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin_category_delete', $category->id_category], 'onsubmit' => 'return ConfirmDelete()']) !!}

                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}

                        {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </table>
            <!-- generate links to the rest of the pages -->

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $categories->render() !!}
        </div>
    </div>

</div>


@endsection