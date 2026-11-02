@extends('layouts.app')

@section('content')
<div class="ix-edit">
    <a class="ix-back" href="{{ url('exambooking') }}">@include('partials.icon', ['name' => 'arrow-left'])<span>Exam Bookings</span></a>

    <h1 class="ix-panel-title">Edit Number of Students and Special Requests</h1>
    <p class="ix-context ix-t" v-pre>{{ $student->code }} · {{ $student->name }}</p>

    <div class="ix-panel">
        @if(count($errors)>0)
            <div class="ix-banner ix-banner--error" role="alert">
                @include('partials.icon', ['name' => 'alert'])
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('updatepage', $id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH">

            <div class="ix-form-grid">
                <div class="ix-field">
                    <label class="ix-label" for="size">Edit Number of Students</label>
                    <input id="size" type="text" name="size" class="ix-input @error('size') is-invalid @enderror" value="{{ $student->size }}" inputmode="numeric" placeholder="Enter Correct Number of Students" @error('size') aria-invalid="true" aria-describedby="size-error" @enderror>
                    @error('size')
                        <p class="ix-field-error" id="size-error">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
                    @enderror
                </div>

                <div class="ix-field">
                    <label class="ix-label" for="time">Special Request Slot AM/PM</label>
                    <select id="time" class="ix-select" name="time">
                        <option value="Any Available slot">Any Available slot</option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>

                <div class="ix-field">
                    <label class="ix-label" for="duration">Duration</label>
                    <select id="duration" class="ix-select" name="duration">
                        <option value="1H">1H</option>
                        <option value="2H">2H</option>
                        <option value="3H">3H</option>
                        <option value="4H">4H</option>
                        <option value="5H">5H</option>
                        <option value="6H">6H</option>
                        <option value="7H">7H</option>
                        <option value="8H">8H</option>
                    </select>
                </div>

                <div class="ix-field">
                    <label class="ix-label" for="paperno">Paper Number</label>
                    <select id="paperno" class="ix-select" name="paperno">
                        <option value="1">Default (1)</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>

                <div class="ix-field">
                    <label class="ix-label" for="special_request_table">Type Of Table</label>
                    <select id="special_request_table" class="ix-select @error('special_request_table') is-invalid @enderror" name="special_request_table" @error('special_request_table') aria-invalid="true" aria-describedby="special_request_table-error" @enderror>
                        <option value="None">None</option>
                        <option value="Single Desk">Single Desk</option>
                        <option value="Double Desk">Double Desk</option>
                        <option value="Drawing Desk">Drawing Desk</option>
                    </select>
                    @error('special_request_table')
                        <p class="ix-field-error" id="special_request_table-error">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
                    @enderror
                </div>

                <div class="ix-field">
                    <label class="ix-label" for="special_request_vanue">Venue Request</label>
                    <input id="special_request_vanue" type="text" name="special_request_vanue" class="ix-input" value="{{ $student->special_request_vanue }}" placeholder="Enter Name of vanue or Type None if no special vanue is required">
                </div>
            </div>

            <div class="ix-form-actions">
                <button type="submit" class="ix-btn ix-btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
