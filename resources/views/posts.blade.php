@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <?                    
                    foreach ($posts as $post) {
                      echo ('<h2>'.$post->title.'</h2>');
                      echo ('<h3>'.$post->category->name.'</h3>');
                      echo ('<img src="/img/'.$post->image.'?w=395&h=213"/>');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
