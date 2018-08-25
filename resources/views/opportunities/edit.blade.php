@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Opportunity</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Opportunity
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            
                            {!! Form::model($opportunity, [
                                'method' => 'PATCH',
                                'url' => ['/opportunities', $opportunity->id],
                                'class' => 'form-horizontal opportunity-form',
                                'files' => true
                            ]) !!}

                            @include ('opportunities.form-edit', ['formMode' => 'edit'])

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection

@section('footer-script')
<script type="text/javascript">
    $(function(){
        var countTask = 2;
        $(document).on('click', '#add-more-task', function(){
            $('#task-div').append('<div class="col-sm-12"><input class="form-control" placeholder="Task-'+countTask+' Description" name="tasks[]" type="text"></div>');
            countTask++;
        });

        $(document).on('click', '.submit-opportunity', function(){
            var id = $(this).attr('id');
            $('input[name="is_published"]').val(id);
            $('.opportunity-form').submit();
        });
        
    }); 
</script>
    
@endsection