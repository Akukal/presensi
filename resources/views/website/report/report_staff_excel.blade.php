<table>
    <tr>
      <th colspan="8" align="center">Presence Report</th>
    </tr>
    <tr>
      <th colspan="8" align="center">Date: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</th>
    </tr>
    <tr>
      <td>Name</td>
      <td colspan="7">{{ $staff->name }}</td>
    </tr>
    <tr>
      <td>Gender</td>
      <td colspan="7">{{ $staff->gender == 1 ? 'Male' : 'Female' }}</td>
    </tr>
    <tr>
      <td>Deparment</td>
      <td colspan="7">{{ $staff->department->name }}</td>
    </tr>
    <tr>
      <td>Position</td>
      <td colspan="7">{{ $staff->position->name }}</td>
    </tr>
    <tr>
      <td>Phone Number</td>
      <td colspan="7">{{ $staff->phone_number }}</td>
    </tr>
    <tr>
      <td>Address</td>
      <td colspan="7">{{ $staff->address }}</td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
      <th width="20">No</th>
      <th width="20">Date</th>
      <th width="20">Clock In</th>
      <th width="20">Clock Out</th>
      <th width="20">Work Duration</th>
    </tr>
    @foreach ($presences as $index => $presence)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $presence->date }}</td>
        <td>{{ empty($presence->clock_in) ? '-' : $presence->clock_in }}</td>
        <td>{{ empty($presence->clock_out) ? '-' : $presence->clock_out }}</td>
        <td>{{ $presence->work_duration }}</td>
      </tr>
    @endforeach
  </table>