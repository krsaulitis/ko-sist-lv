@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Resursi
                </div>
                <div class="card-body">
                    <form action="{{url('/submissions/submissions')}}" method="post">
                        <label>Vārds:</label><br>
                        <input type="text" name="name"/><br>
                        <label>Uzvārds:</label><br>
                        <input type="text" name="surname"/><br>
                        <label>Telefona nr.:</label><br>
                        <input type="text" name="phone_number"/><br>
                        <label>E-pasts:</label><br>
                        <input type="email" name="email"/><br>
                        <label>Iepriekšējā pieredze:</label><br>
                        <input type="text" name="experience"/><br>
                        <label>Motivācijas vēstule:</label><br>
                        <input type="text" name="motivation"/><br>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
