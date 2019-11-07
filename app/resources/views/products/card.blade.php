@extends('home')
@section('main')

<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="col-sm-12 offset-sm-0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 align="center" class="panel-title">{{$tab[0]->name}}</h1>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br />
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <img class="img-thumbnail"
             src="{{$tab[0]->url_img}}"
             alt="User Pic">
    </div>

    <div class="col-md-8">
        <div class="span6">
            <p>De : <strong>{{$tab[0]->author}}</strong></p>
            <p>Date de sortie : </p>
            <p>Genre : {{$tab[0]->category_id}}</p>
            <p>
                <span style="color: orange;" class="fa fa-star"></span>
                <span style="color: orange;" class="fa fa-star"></span>
                <span style="color: orange;" class="fa fa-star"></span>
                <span style="color: orange;" class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <big> 4/5 </big>
            </p>
            <p>Description : {{$tab[0]->description}}</p>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalResa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="post" action="{{ route('reservations.store') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Réserver cette oeuvre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->id}}"/>
                            <input type="hidden" class="form-control" name="product_id" value="{{$tab[0]->id}}"/>
                        <h3>Attention, vous avez 7 jours pour récuperer votre exemplaire</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="modalLoan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post" action="{{ route('loan.store') }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un emprunt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <label>Nom de l'utilisateur:</label>
                <select name="user_id">
                    @foreach($tab[1] as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <input type="hidden" class="form-control" name="product_id" value="{{$tab[0]->id}}"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>
</div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                @if($tab[0]->available)
                @if(Auth::user()->admin)
                <button class="btn  btn-primary" type="button" data-toggle="modal" data-target="#modalLoan"> Ajouter un emprunt <i class="icon-envelope icon-white"></i></button>
                @else
                <button class="btn  btn-primary" type="button" data-toggle="modal" data-target="#modalResa"> Réserver <i class="icon-envelope icon-white"></i></button>
                @endif
                @else
                <button class="btn  btn-primary" type="button" data-toggle="modal" data-target="#modalResa"disabled> Indisponible <i class="icon-envelope icon-white"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
