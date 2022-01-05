<table class="table">
    <thead>
        <tr>
            <th colspan="3" class="text-center">MEDICAL-DENTAL UNIT
            </th>
        </tr>
        <tr>
            <th colspan="3" class="text-center"><h5>{{"Year ". $year}}</h5>
            </th>
        </tr>
        <tr>
            <th>Expired Medicines</th>
            <th class="text-center">Date Expired</th>
            <th class="text-center">Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
            <tr>
                <td>{{ucfirst($report->name)}}</td>
                <td class="text-center">{{$report->expiration_day}}</td>
                <td class="text-center">{{$report->stock}}</td>
                {{-- @foreach ($designations as $designation)
                    <td class="text-center">{{$report[$medicine_name][$designation->id]['count'] ?? '0'}}</td>
                @endforeach --}}
                {{-- <td class="text-center">{{$totalCountPerDocs[$document] ?? '0'}}</td> --}}
            </tr>
        @endforeach
        
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Total No. of Medicine Expired</strong></td>
            <td></td>
            <td class="text-center">
                @foreach ($totalExpired as $totalMedicine)
                    {{$totalMedicine->expired}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Prepared By: MICHELE LACSON</strong></td>
            <td></td>
            <td><strong>Noted By: ELMER C. DIOCARES, Ma.Ed</strong></td>
        </tr>
        <tr>
            <td><strong>Campus Nurse</strong></td>
            <td></td>
            <td><strong>Coordinator, Student Services</strong></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Recommending Approval: RENE D, CACHO, MAVTE</strong></td>
            <td></td>
            <td><strong>Approved By: RENATO E. SALCEDO, Ph.D</strong></td>
        </tr>
        <tr>
            <td><strong>Administrative Officer,</strong></td>
            <td></td>
            <td><strong>Campus Executive Director</strong></td>
        </tr>
    </tbody>
</table>