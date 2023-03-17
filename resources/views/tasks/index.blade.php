@extends('layouts.master')

@section('content')
<style>
    /* .kanban-item.success{
        color: #ffffff;
        background-color: #1ee0ac;
    }
    .kanban-item.warning{
        color: #ffffff;
        background-color: #f4bd0e;
    }
    .kanban-item.info{
        color: #ffffff;
        background-color: #09c2de;
    } */
</style>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            @include('partials.alerts')
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="custom-menu-input">
                                                <select class="filter_by form-select" name="filter_by" data-placeholder="Filter by">
                                                    <option value="all" {{ request('p') == 'all' ? 'selected' : ''}}>All</option>
                                                    @foreach ($projects as $key => $project)
                                                        <option value="{{ $key }}" {{ request('p') == $key ? 'selected' : ''}}>{{ $project }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li><a href="{{ route('task.create') }}" class="btn btn-white btn-outline-light"><em class="icon ni ni-plus"></em><span>Add Task</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div id="kanban" class="nk-kanban"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let tasks = @json($kanbanData);
    var kanban = new jKanban({
        element          : '#kanban',
        responsivePercentage: true,
        dragItems        : true,
        boards           : [
            {
                "id"    : "tasks-board",
                "title" : "Tasks",
                "class" : "h4",
                "item"  : tasks
            }
        ],
        dragBoards       : false,
        dropEl           : function (el, target, source, sibling) {
            var tasks = [];
            ($(source).children()).each((index, element)=> {
                element.setAttribute('data-p', (index + 1))
                tasks.push((element.getAttribute('data-eid')).split('_')[2])
            });

            $.ajax({
                url : "{{ route('task.change-priority') }}",
                data: {tids:tasks},
                success: function(res){
                },
                error: function(err){
                    console.log(err)
                }
            });
        },
    })

    checkIfItemExist()

    function modifyTask($id){
        var url = "{{ route('task.edit', ['TID']) }}";
        url = url.replace("TID", $id);
        window.location = url;
    }

    function removeTask($id){
        var url = "{{ route('task.destroy', ['TID']) }}";
        url = url.replace("TID", $id);
        if(confirm('Are you sure?')){
            $.ajax({
            url: url,
            type: 'delete',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.status == 200){
                    kanban.removeElement('task_id_'+$id);
                    checkIfItemExist()
                }
            }
        });
        }
    }

    $(document).on('change', '.filter_by', function(){
        let filter_by = $(this).val()
        window.location = "{{ url('task') }}?p="+filter_by;
    })

    function checkIfItemExist(){
        if (kanban.getBoardElements('tasks-board').length === 0) {
            kanban.addElement('tasks-board', {
                'title': 'No tasks',
                'drag': false
            });
        }
    }
    </script>
@endpush
