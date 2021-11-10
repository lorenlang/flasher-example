
<!-- BEGIN USER PROFILE BLOCK -->
<div class="card card-border mb-3 border-primary clickable">
    <a href="{{ route('profile') }}" onclick="showSpinner();">
        <div class="card-body">

            <div class="m-t-30 text-center">
                <img src="{{ $employee->avatar() }}" alt="Employee image" class="rounded-circle"
                     width="150">
                <h4 class="card-title mt-4">{{ $employee->DisplayName }}</h4>
                <h6 class="card-subtitle">{{ $employee->JobDescription }}</h6>
                <div class="row text-center justify-content-md-center">
                </div>
            </div>

            <hr>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <small class="text-muted p-t-30 db">Address</small>
                        <h6>{!! join('<br />',formatEmployeeAddress($employee)) !!}</h6>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">Email address</small>
                        <h6>{{ $employee->Email }}</h6>
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6>{{ formatEmployeePhone($employee->HomePhone) }}</h6>
                    </div>
                </div>
            </div>


        </div>

        <div class="card card-footer border-0 text-center shadow-none">
            <small>Click inside this box to update</small>
        </div>
    </a>
</div>
<!--  END USER PROFILE BLOCK  -->
