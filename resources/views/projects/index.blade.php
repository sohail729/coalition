@extends('layouts.master')

@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        {{-- <div class="nk-block-head-content">
            <h4 class="nk-block-title">Data Table</h4>
            <div class="nk-block-des">
                <p>Using the most basic table markup, here’s how <code class="code-class">.table</code> based tables look by default.</p>
            </div>
        </div> --}}
        @include('partials.alerts')
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $statusArr = collect(config('constants.project_status'));
                    @endphp
                    @foreach ($projects as $key => $project )
                    <tr>
                        <td><strong>{{ $project->title }}</strong></td>
                        <td>
                            @foreach ($statusArr as $key => $status)
                                @if($key  ==  $project->status )
                                    <span class="badge bg-{{ $status['badge'] }}">{{ $status['name'] }}</span>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $project->owner->name ?? 'Admin' }}</td>
                        <td>{{ $project->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
@endsection
