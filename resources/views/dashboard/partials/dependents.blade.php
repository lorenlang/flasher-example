
<!-- BEGIN DEPENDENTS BLOCK -->
<div class="main-card mb-3 card card-border border-primary">
{{--<div class="main-card mb-3 card card-border border-primary clickable">--}}

{{--    <a href="dependents.html">--}}
        <div class="card-body"><h5 class="card-title">Your Dependents</h5>
            <table id="dependents" class="mb-0 table">
                <tbody>

                @foreach($dependents as $dependent)
                    <tr>
                        <td>{{ $dependent->FirstName }}<br /><small>{{ $dependent->Relationship }}</small></td>
                        <td>{{ $dependent->LastName }}<br /><small>{{ $dependent->BirthDate->format('M d, Y') }}</small></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

{{--        <div class="card card-footer border-0 text-center shadow-none">--}}
{{--            <small>Click inside this box to update</small>--}}
{{--        </div>--}}
{{--    </a>--}}
</div>
<!--  END DEPENDENTS BLOCK  -->
