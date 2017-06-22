@extends('voyager::master')

@section('page_title','View '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> Viewing {{ ucfirst($dataType->display_name_singular) }} &nbsp;
        @if(Auth::user()->role_id == 1)
        <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            Edit
        </a>
        @endif
    </h1>
@stop



@section('content')
    <div class="page-content container-fluid">
        <form action="/admin/homework-answers/create">
            @foreach($dataType->readRows as $row)
                @if($row->field == 'user_id')
                    <input type="hidden" name="user_id" value="{{ $dataTypeContent->{$row->field} }}">
                @elseif($row->field == 'lesson_id')
                    <input type="hidden" name="lesson_id" value="{{ $dataTypeContent->{$row->field} }}">
                @elseif($row->field == 'id')
                    <input type="hidden" name="question_id" value="{{ $dataTypeContent->{$row->field} }}">
                @endif
            @endforeach


                <input type="hidden" name="new" value="1">
                <input type="hidden" name="answer_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Answer</button>
        </form>
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">


                    <!-- /.box-header -->
                    <!-- form start -->


                    @foreach($dataType->readRows as $row)
                        @php $rowDetails = json_decode($row->details); @endphp

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">{{ $row->display_name }}</h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            @if($row->type == "image")
                                <img style="max-width:640px"
                                     src="{{ Voyager::image($dataTypeContent->{$row->field}) }}">
                            @elseif($row->type == 'select_dropdown' && property_exists($rowDetails, 'options') &&
                                    !empty($rowDetails->options->{$dataTypeContent->{$row->field}})
                            )

                                <?php echo $rowDetails->options->{$dataTypeContent->{$row->field}};?>
                            @elseif($row->type == 'select_dropdown' && $dataTypeContent->{$row->field . '_page_slug'})
                                <a href="{{ $dataTypeContent->{$row->field . '_page_slug'} }}">{{ $dataTypeContent->{$row->field}  }}</a>
                            @elseif($row->type == 'select_multiple')
                                @if(property_exists($rowDetails, 'relationship'))

                                    @foreach($dataTypeContent->{$row->field} as $item)
                                        @if($item->{$row->field . '_page_slug'})
                                        <a href="{{ $item->{$row->field . '_page_slug'} }}">{{ $item->{$row->field}  }}</a>@if(!$loop->last), @endif
                                        @else
                                        {{ $item->{$row->field}  }}
                                        @endif
                                    @endforeach

                                @elseif(property_exists($rowDetails, 'options'))
                                    @foreach($dataTypeContent->{$row->field} as $item)
                                     {{ $rowDetails->options->{$item} . (!$loop->last ? ', ' : '') }}
                                    @endforeach
                                @endif
                            @elseif($row->type == 'date')
                                {{ $rowDetails && property_exists($rowDetails, 'format') ? \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($rowDetails->format) : $dataTypeContent->{$row->field} }}
                            @elseif($row->type == 'checkbox')
                                @if($rowDetails && property_exists($rowDetails, 'on') && property_exists($rowDetails, 'off'))
                                    @if($dataTypeContent->{$row->field})
                                    <span class="label label-info">{{ $rowDetails->on }}</span>
                                    @else
                                    <span class="label label-primary">{{ $rowDetails->off }}</span>
                                    @endif
                                @else
                                {{ $dataTypeContent->{$row->field} }}
                                @endif
                            @else

                                @if($row->field == 'user_id')
                                    <?
                                    $dataI = App\User::find($dataTypeContent->user_id);
                                    ?>
                                    <p>{{ $dataI->name }}</p>
                                @elseif($row->field == 'lesson_id')
                                    <?
                                    $dataI = App\Lesson::find($dataTypeContent->lesson_id);
                                    ?>
                                    <p>{{ $dataI->title }} | {{ $dataI->cours->title }}</p>
                                @else
                                    <p>{{ $dataTypeContent->{$row->field} }}</p>
                                @endif


                            @endif
                        </div><!-- panel-body -->
                        @if(!$loop->last)
                            <hr style="margin:0;">
                        @endif
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop