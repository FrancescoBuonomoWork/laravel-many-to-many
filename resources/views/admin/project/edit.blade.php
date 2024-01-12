@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{route('admin.project.update',$project)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nome progetto</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name',$project->name)}}">
                </div>

                <div class="mb-3">
                  <label for="image">Image</label>
                  <input type="file" name="image" class="form-control-file" id="image">
                </div>

                <div class="mb-3">
                    <label for="type_id" class="form-label">Tipo</label>
                    <select name="type_id" class="form-control" id="type_id">
                      <option value="">Seleziona una tipo</option>
                      @foreach($types as $type)
                        <option @selected( old('type_id',optional($project->type)->id) ==  $type->id ) value="{{ $type->id }}">{{ $type->name }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                        <p>Seleziona le tecnologie:</p>
                        <div class="d-flex flex-wrap gap-4 ">
                          @foreach ($technologies as $technology)
                            <div class="form-check">
                              <input name="technologies[]" class="form-check-input" type="checkbox" value="{{$technology->id}}"
                              @checked(in_array($technology->id, old('technologies', $project->technologies->pluck('id')->all())))
                              id="technology-{{$technology->id}}">
                              {{-- in_array() prende due paramentri e controlla che il primo é compreso nel secondo che deve essere un array obligatoriamente --}}
                              {{-- old prende due parametre nel caso il form venga inviato prende il primo quindi in questo caso stesso dal form  --}}
                              {{-- mentre come secondo parametro dobbiamo recuperare dal progetto le technologia tramite il id pluck() e poi il metodo all() lo trasforma in un array e viene accettato dal metodo in_array() --}}

                              {{-- <!--{{ in_array($technology->id, $project->technologies->pluck('id')->toArray()) ? 'checked' : '' }}-->
                              <!-- @checked( in_array($technology->id, old('technologies',[]) ) ) --> --}}
                              {{-- @checked(old('technologies[]', $technology->id)) --}}
                              <label class="form-check-label" for="technology-{{$technology->id}}">
                                {{ $technology->name }}
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>

                <button type="submit" class="btn btn-success">Aggiungi</button>
            </form>
             {{-- questo if mi permette di vedere il messaggio di errore quando modifico un elemento  --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection