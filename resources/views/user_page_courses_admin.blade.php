@extends('layouts.user')

@section('content')
<div class="inner-container__main">
   <header><h2 class="inner-container__main-title">Курсы</h2></header>

   <div class="course-list">
       @include('layouts.courses.course_list_admin')
   </div>
</div>
@endsection


