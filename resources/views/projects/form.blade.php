@extends('layouts.master')

@section('content')
<div class="nk-block nk-block-lg">
    {{-- <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Basic Form Style - S2</h4>
            <div class="nk-block-des">
                <p>You can alow display form in column as example below.</p>
            </div>
        </div>
    </div> --}}
    <div class="card card-bordered">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Create new project</h5>
            </div>
                @if(isset($project))
                {!! Form::model($project, ['route' => ['project.update', $project->id ?? null], 'class' => 'form-validate','autocomplete' => 'off']) !!}
                @method('put')
                @else
                {!! Form::model([], ['route' => ['project.store'], 'class' => 'form-validate', 'autocomplete' => 'off']) !!}
                @method('post')
                @endif
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('title', 'Title', ['class' => 'form-label'], false); !!}
                            <div class="form-control-wrap">
                                {!! Form::text('title', '', ['class' => 'form-control', 'required' => 'required']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('description', 'Description', ['class' => 'form-label']); !!}
                            <div class="form-control-wrap">
                                {!! Form::textarea('description', '', ['class' => 'form-control', 'required' => 'required']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('status', 'Status', ['class' => 'form-label'], false); !!}
                            <div class="form-control-wrap">
                                @php
                                $statusArr = collect(config('constants.project_status'))->pluck('name');
                                @endphp
                               {!! Form::select('status', $statusArr, $statusArr[0], ['class' => 'form-control', 'required' => 'required']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-success">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->
@endsection
