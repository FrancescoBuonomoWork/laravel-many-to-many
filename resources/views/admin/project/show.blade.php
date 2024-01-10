@extends('layouts.app')

@section('content')


    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul>
                        <li>{{$project->name}}</li>
                        <li>{{isset($project->type) ? $project->type->name : '-'}}</li>
                    </ul>
                    <ul class="d-flex gap-2">
                        @foreach ($project->technologies as $technology)
                        
                        <li class="badge rounded-pill text-bg-primary">{{$technology->name }}</li>
                        @endforeach
                    </ul>
                    
                    
                </div>
            </div>
        </div>
    </section>
@endsection