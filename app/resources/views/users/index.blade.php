@extends('home')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Utilisateurs</h1>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nom</td>
          <td>Email</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($utilisateurs as $utilisateur)
        <tr>
            <td>{{$utilisateur->id}}</td>
            <td>{{$utilisateur->name}}</td>
            <td>{{$utilisateur->email}}</td>
            <td>
                <a href="{{ route('user.edit',$utilisateur->id)}}" class="btn btn-primary">Modifier</a>
            </td>
            <td>
                <form action="{{ route('user.destroy', $utilisateur->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection
