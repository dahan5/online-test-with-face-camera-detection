@extends('layout')
@section('content')
    @if(request('status')=='disqualification')
    <div class="alert alert-warning">
        You have been disqualified!
    </div>
    @endif
    <h2>Personal Data</h2>
    <hr>
    <p>Please fill in your personal data:</p>
    <form method="post" action="{{ url('save-personal') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <input type="tel" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Select Position</label>
            <select name="position" required class="form-control">
                <option value="">** Choose Position</option>
                <option value="Frontend Engineer">Frontend Engineer</option>
                <option value="Laravel Backend Engineer">Laravel Backend Engineer</option>
                <option value="Android Engineer">Android Engineer</option>
                <option value="IOS Engineer">IOS Engineer</option>
            </select>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <input type="checkbox" checked required name="agree"> Before taking this online test, you have agreed to follow the rules and procedures of this online test.
            <ol>
                <li>Use the chrome browser</li>
                <li>Make sure your computer is equipped with WebCam</li>
                <li>Please find a comfortable and quiet place to test online</li>
                <li>Make sure your room lighting is bright especially in the face area</li>
                <li>Not allowed to open other gadgets / smartphones / computers to find answers</li>
                <li>Not allowed to open other browsers/tabs to find answers</li>
                <li>It is not allowed to leave the online test form during the course</li>
                <li>Not using cheats/cheats/asking to help others to answer online tests</li>
                <li>Do the online test according to the predetermined time</li>
            </ol>
            Any form of fraud will be directly disqualified by us
        </div>
        <br>
        <button type="submit" class="btn w-100 btn-primary">Begin</button>
    </form>
@endsection
