<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Administration</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Teachers</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Add New</a></li>
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Hire Teacher Form
            </div>
        </div>
        <!--end::Header-->
        <form method="post" action="{{ route('teachers.store') }}">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Teacher Info:</h3>
                <div class="row">
                    <x-input.group class="col-lg-2" label="Title" for="title" :error="$errors->first('title')">
                        <x-input.text id="title" placeholder="Enter title" name="title" value="{{ old('title') }}" />
                    </x-input.group>

                    <x-input.group class="col-lg-4" label="First Name" for="first_name" :error="$errors->first('first_name')">
                        <x-input.text id="first_name" placeholder="Enter first name" name="first_name" value="{{ old('last_name') }}" />
                    </x-input.group>

                    <x-input.group class="col-lg-4" label="Last Name" for="last_name" :error="$errors->first('last_name')">
                        <x-input.text id="last_name" placeholder="Enter last name" name="last_name" value="{{ old('last_name') }}" />
                    </x-input.group>

                    <x-input.group class="col-lg-2" label="Suffix" for="suffix" :error="$errors->first('suffix')">
                        <x-input.text id="suffix" placeholder="Enter suffix" name="suffix" value="{{ old('suffix') }}" />
                    </x-input.group>
                </div>

                <div class="row">
                    <x-input.group class="col-lg-6" label="Secondary Email Address" for="email" :error="$errors->first('email')" helpText="We will create a new school email for you.">
                        <x-input.text id="email" placeholder="Enter email address" name="email" value="{{ old('email') }}" />
                    </x-input.group>

                    <x-input.group class="col-lg-6" label="Phone Number" for="phone" :error="$errors->first('phone')" helpText="Phone number format: (999) 999-9999">
                        <x-input.phone name="phone" value="{{ old('phone') }}" />
                    </x-input.group>
                </div>

                <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Address:</h3>

                <x-input.group label="Street" for="street" :error="$errors->first('street')">
                    <x-input.text id="street" placeholder="Enter street" name="street" value="{{ old('street') }}" />
                </x-input.group>

                <div class="row">
                    <x-input.group class="col-lg-4" label="City" for="city" :error="$errors->first('city')">
                        <x-input.text id="city" placeholder="Enter city" name="city" value="{{ old('city') }}" />
                    </x-input.group>

                    <x-input.group class="col-lg-4" label="State" for="state" :error="$errors->first('state')">
                        <x-input.text id="state" placeholder="Enter state" name="state" value="{{ old('state') }}" />
                    </x-input.group>

                    <x-input.group class="col-lg-4" label="Zip" for="zip" :error="$errors->first('zip')">
                        <x-input.text id="zip" placeholder="Enter zip" name="zip" value="{{ old('zip') }}" />
                    </x-input.group>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
            <!--end::Footer-->
        </form>
    </div>
    <!--end::Card-->
</x-layout>
