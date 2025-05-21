<table>
  <tr>
    <th colspan="8" align="center">Presence Report</th>
  </tr>
  <tr>
    <th colspan="8" align="center">Date: {{ $date->format('d F Y') }}</th>
  </tr>
  <tr>
    <th>No</th>
    <th>Name</th>
    <th>Department</th>
    <th>Position</th>
    <th>Date</th>
    <th>Clock In</th>
    <th>Clock Out</th>
    <th>Work Duration</th>
  </tr>
  @foreach ($presences as $index => $presence)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td width="20">{{ $presence->staff->name }}</td>
      <td width="20">{{ $presence->staff->department->name }}</td>
      <td width="20">{{ $presence->staff->position->name }}</td>
      <td width="20">{{ $presence->date }}</td>
      <td width="20">{{ empty($presence->clock_in) ? '-' : $presence->clock_in }}</td>
      <td width="20">{{ empty($presence->clock_out) ? '-' : $presence->clock_out }}</td>
      <td width="20">{{ $presence->work_duration }}</td>
    </tr>
  @endforeach
</table>