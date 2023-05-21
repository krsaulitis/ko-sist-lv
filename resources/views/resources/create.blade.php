@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Jauns resurss</div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="/api/resources/create"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <label class="form-label" for="title">Nosukums</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="file">Fails</label>
                                <input type="file" class="form-control" id="file" name="file"
                                       accept=".jpg, .png, .pdf" required>
                                <div class="form-text">Tikai .jpg, .png, .pdf faili ir atļauti.</div>
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">Saglabāt</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('form')
            .addEventListener('submit', async function (e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);

                let data;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                    });

                    data = await response.json();
                } catch (e) {
                    console.error(e);
                    // todo: display error
                    return;
                }

                if (!data.success) {
                    // todo: display error
                    console.error(data.message);
                    return;
                }

                window.location.href = "<?= route('resources-list') ?>";
            });
    </script>
@endsection

