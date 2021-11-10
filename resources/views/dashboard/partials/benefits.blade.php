
<!-- BEGIN BENEFITS BLOCK -->
<div class="col-12 px-0">

    <div class="card card-border mb-3 border-primary">
        <div class="card-body">
            <h5 class="card-title">Your Benefits</h5>
{{--            <div class="text-center small">Click on a item to view details</div>--}}

            <table class="mb-0 table table-hover">
                <tbody>

                @foreach($benefits as $benefit)
                    <tr>
{{--                    <tr class="clickable">--}}
                        <td class="pl-4">
                            {{ $benefit->Description }}
{{--                            <a href="benefit.html">{{ $benefit->Description }}</a>--}}
                        </td>
                        <td class="pl-4">
{{--                            {{ $benefit->Status }}--}}
{{--                            <a href="benefit.html">{{ $benefit->Status }}</a>--}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
<!--  END BENEFITS BLOCK  -->
