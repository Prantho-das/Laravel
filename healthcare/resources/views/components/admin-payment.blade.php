<div class="block-content block-content-full">
    <div class="tab-content mt-3">
        <div class="tab-pane active" id="evaluatedCase">
            <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Case ID</th>
                        <th>Patient Name</th>
                        <th>category</th>
                        <th>Transaction Id</th>
                        <th>Transaction Date</th>
                        <th>Total Amount</th>
                        <th>Due Amount</th>
                        <th>Paymode</th>
                        {{-- <th>Status</th> --}}
                        <th>Details</th>
                    </tr>
                </thead>
            <tbody>

                    @forelse ($payment as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>CASE-{{$item->id}}</td>
                        <td><a href='{{url('user_profile/'.$item->u_id)}}'>{{$item->name?$item->name:''}}</a></td>
                        <td>{{$item->category_name?$item->category_name:''}}</td>
                        <td>{{$item->transaction_id}}</td>
                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{$item->due_amount?$item->due_amount:0}}</td>
                        <td>
                        {{-- {{$item->cardname?$item->cardname:0}} --}}
                            @php
                            $mystring = $item->cardname;
                            $first = strtok($mystring, '-');
                            echo $first;
                            @endphp
                        </td>
                        {{-- <td>{{$item->status==="Processing"?"Paid":"Unpaid"}}</td> --}}
                        <td>
                            <a href='{{url('case_details/'.encrypt($item->case_id))}}' class="btn btn-info">View</a>
                            <a class='btn btn-info rounded mx-3' href='{{url('payment/invoice/'.$item->transaction_id)}}'>
                                <i class="fas fa-file-invoice"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <h5 class='text-center'>
                            Sorry, Tansection Not Found!
                        </h5>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
