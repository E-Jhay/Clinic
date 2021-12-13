<table class="table">
    <thead>
        <tr>
            <th colspan="5" class="text-center">MEDICAL-DENTAL UNIT
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center"><h5>{{$quarter." Quarter of ". $year}}</h5>
            </th>
        </tr>
        <tr>
            <th>Medical Services Rendered</th>
            @foreach ($designations as $designation)
                <th class="text-center">{{$designation->name}}</th>
            @endforeach
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $medical_service => $values)
        <tr>
            <td>{{ucfirst($medical_service)}}</td>
            @foreach ($designations as $designation)
                <td class="text-center">{{$report[$medical_service][$designation->id]['count'] ?? '0'}}</td>
            @endforeach
            <td></td>
            {{-- <td class="text-center">{{$totalCountPerDocs[$document] ?? '0'}}</td> --}}
        </tr>
        @endforeach
        <tr>
            <td><strong>No. of Services Rendered</strong></td>
            @foreach ($designations as $designation)
                <td class="text-center">{{$totalCountPerDesignation[$designation->id] ?? '0'}}</td>
            @endforeach
            <td></td>
            {{-- <td></td>
            <td></td>
            <td></td>
            <td class="text-center">Total</td>
            <td class="text-center">{{$totalCount}}</td> --}}
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><strong>Total No. of Services Rendered</strong></td>
            <td class="text-center">{{$totalCount}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Prepared By: MICHELE LACSON</strong></td>
            <td></td>
            <td colspan="2"><strong>Noted By: ELMER C. DIOCARES, Ma.Ed</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Campus Nurse</strong></td>
            <td></td>
            <td colspan="2"><strong>Coordinator, Student Services</strong></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Recommending Approval: RENE D, CACHO, MAVTE</strong></td>
            <td></td>
            <td colspan="2"><strong>Approved By: RENATO E. SALCEDO, Ph.D</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Administrative Officer,</strong></td>
            <td></td>
            <td colspan="2"><strong>Campus Executive Director</strong></td>
        </tr>
    </tbody>
</table>