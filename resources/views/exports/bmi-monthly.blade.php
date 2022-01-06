<table class="table">
    <thead>
        <tr>
            <th colspan="5" class="text-center">MEDICAL-DENTAL UNIT
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center"><h5>{{\Carbon\Carbon::createFromFormat('m', $month)->format('F')." ". $year}}</h5>
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Height</th>
            <th>Weight</th>
            <th>BMI</th>
            <th>Classification</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
            <tr>
                <td>{{ucfirst($report->health_profile->first_name) ." ". ucfirst($report->health_profile->middle_name) ." ". ucfirst($report->health_profile->last_name)}}</td>
                <td>{{$report->height}}</td>
                <td>{{$report->weight}}</td>
                <td>{{$report->bmi}}</td>
                <td>{{$report->classification->name}}</td>
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
            <td><strong>Prepared By: MICHELE LACSON</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Noted By: ELMER C. DIOCARES, Ma.Ed</strong></td>
        </tr>
        <tr>
            <td><strong>Campus Nurse</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Coordinator, Student Services</strong></td>
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
            <td><strong>Recommending Approval: RENE D, CACHO, MAVTE</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Approved By: RENATO E. SALCEDO, Ph.D</strong></td>
        </tr>
        <tr>
            <td><strong>Administrative Officer,</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Campus Executive Director</strong></td>
        </tr>
    </tbody>
</table>