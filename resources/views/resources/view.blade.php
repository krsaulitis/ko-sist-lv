@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
    .container {
        max-width: 500px;
    }
    dl, ol, ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
<script>

    $(document).on('click', '#modalResource', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#resource_entry_modal').modal("show");
                $('#mediumModalResource').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <button class="card-header btn " id="modalResource">PIEVIENOT RESURSU</button>
            </div>
        <div>
            <div class="modal fade" id="resource_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelResource">Pievienot jaunu resursu</h5>

                        </div>
                        <div class="modal-body" id="mediumModalResource">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="resource_name">Nosaukums</label>
                                            <input type="text" name="resource_name" id="resource_name" class="form-control" placeholder="Enter your event name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Izvēlieties failu</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-
                                    dismiss="modal"><a href="{{route('resources-view')}}" style="color: white; text-decoration: none;">Aizvērt</a></button>
                            <button type="submit" class="btn btn-primary" ><a href="{{route('fileUpload')}}" style="color: white; text-decoration: none;">Augšupielādēt</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card">
            <div class="card-header">Resursu saraksts</div>
        <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nosaukums</th>
                                <th scope="col">Datums</th>
                            </tr>
                            </thead>
                            @foreach($resources as $resource)
                            <tbody>
                            <tr>
                                <td>{{$resource->name}}</td>
                                <td>{{$resource->updated_at}}</td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
